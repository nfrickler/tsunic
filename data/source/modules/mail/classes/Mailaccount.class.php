<!-- | mail account class -->
<?php
include_once '$system$Object.class.php';
class $$$Mailaccount extends $system$Object {

	/* SMPT objects
	 * array
	 */
	protected $smtps;

	/* serverbox objects
	 * array
	 */
	protected $serverboxes;

	/* password of mailaccount
	 * string
	 */
	private $password;

	/* time in seconds after local serverbox information has to be updated
	 * int
	 */
	protected $frequenceServerboxUpdate;

	/* password authentifications
	 * array
	 */
	protected $auths = array(
		1 => array('{CLASS__ACCOUNT__AUTHS_NORMAL}', ''),
		2 => array('{CLASS__ACCOUNT__AUTHS_ENCRYPTEDPWD}', 'secure'),
		//   3 => array('{CLASS__ACCOUNT__AUTHS_NTLM}', ''), // not supported
		//   4 => array('{CLASS__ACCOUNT__AUTHS_KERBEROS_GSSAPI}', '') // not supported
	);

	/* protocols
	 * array
	 */
	protected $protocols = array(
		1 => array('{CLASS__ACCOUNT__PROTOCOLS_IMAP}', 'imap'),
		2 => array('{CLASS__ACCOUNT__PROTOCOLS_POP3}', 'pop3')
	);

	/* connections-securities
	 * array
	 */
	protected $connsecurities = array(
		1 => array('{CLASS__ACCOUNT__CONNSECURITIES_NONE}', 'novalidate-cert'),
		2 => array('{CLASS__ACCOUNT__CONNSECURITIES_STARTTLS}', 'tls/novalidate-cert'),
		3 => array('{CLASS__ACCOUNT__CONNSECURITIES_SSLTLS}', 'ssl'),
		4 => array('{CLASS__ACCOUNT__CONNSECURITIES_SSLTLSNOVAL}', 'ssl/novalidate-cert')
	);

	/* imap-timeout (in seconds)
	 * int
	 */
	protected $timeout = 3;

	/* constructor
	 * +@params int: ID
	 */
	public function __construct ($id = 0) {

		// set $frequenceServerboxUpdate
		$this->frequenceServerboxUpdate = 60 * 60 * 24 * 7;

		return parent::__construct($id);
	}

	/* load infos from database
	 *
	 * @return sql query
	 */
	protected function loadInfoSql () {
		return "SELECT _name_ as name,
				_description_ as description,
				dateOfCreation,
				dateOfUpdate,
				_email_ as email,
				_password_ as password,
				_host_ as host,
				_user_ as user,
				protocol,
				connsecurity,
				auth,
				lastServerboxUpdate
			FROM #__accounts
			WHERE id = '$this->id';";
	}

	/* load information about object
	 */
	protected function loadInfo () {
		$return = parent::loadInfo();

		// handle password
		if (isset($this->info['password'])) {
			$this->password = $this->info['password'];
			unset($this->info['password']);
		}

		return $return;
	}

	/* get all serverboxes of this server
	 *
	 * @return array
	 */
	public function getServerboxes () {

		// already computed OR invalid account?
		if (!$this->isValid()) return array();
		if (!empty($this->serverboxes)) return $this->serverboxes;

		// get timestamp from mysql-datetime (TODO: exclude in time-class)
		list($date, $time) = explode(' ', $this->getInfo('lastServerboxUpdate'));
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

		// update serverboxes?
		$timesince = time() - $timestamp;
		if ($timesince >= $this->frequenceServerboxUpdate) $this->updateServerboxes();

		// get serverboxes from database
		global $TSunic;
		$sql = "SELECT id
			FROM #__serverboxes
			WHERE fk_mail__account = '".$this->id."';";
		$result = $TSunic->Db->doSelect($sql);

		// get serverbox objects
		$this->serverboxes = array();
		foreach ($result as $index => $values) {
			$this->serverboxes[] = $TSunic->get('$$$Serverbox', $values['id']);
		}

		return $this->serverboxes;
	}

	/* get all available connection-security-options
	 *
	 * @return array
	 */
	public function getAllConnsecurities () {
		return $this->connsecurities;
	}

	/* get all available password-authentication-options
	 *
	 * @return array
	 */
	public function getAllAuths () {
		return $this->auths;
	}

	/* get all available protocol-options
	 *
	 * @return array
	 */
	public function getAllProtocols () {
		return $this->protocols;
	}

	/* get all smtps of this account
	 *
	 * @return array
	 */
	public function getSmtps () {
		if (!empty($this->smtps)) return $this->smtps;
		global $TSunic;

		// get smtps from database
		global $TSunic;
		$sql = "SELECT id
			FROM #__smtps
			WHERE fk_mail__account = '".$this->id."';";
		$result = $TSunic->Db->doSelect($sql);

		// get objects
		$this->smtps = array();
		foreach ($result as $index => $values) {
			$this->smtps[] = $TSunic->get('$$$Smtp', $values['id']);
		}

		return $this->smtps;
	}

	/* set connection for mailaccount
	 * @param string: host to connect to mail-account
	 * @param string: user to connect to mail-account
	 * @param int: port to connect to mail-account
	 * @param int/string: protocol
	 * @param int/string: connection-security
	 * @param int/string: password-authentification
	 *
	 * @return bool
	 */
	public function setConnection ($host, $port, $user, $protocol, $connsecurity, $auth) {
		global $TSunic;

		// invalid connection?
		if (!$this->validateConnection(
			$host, $port, $user, $protocol, $connsecurity, $auth
		)) return false;

		// update connection-data
		$host = $this->info['host'];
		$port = $this->info['port'];
		$user = $this->info['user'];
		$protocol = $this->info['protocol'];
		$connsecurity = $this->info['connsecurity'];
		$auth = $this->info['auth'];

		// validate input
		if (!$this->isValidHost($host)
			or !$this->isValidUser($user)
			or !$this->isValidPort($port)
		) return false;

		// save in db
		$sql = "UPDATE #__accounts
			SET _host_ = '$host',
				_user_ = '$user',
				_port_ = '$port',
				protocol = '".$this->getProtocol($protocol, true)."',
				connsecurity = '".$this->getConnsecurity($connsecurity, true)."',
				auth = '".$this->getAuth($auth, true)."'
			WHERE id = '".$this->id."';
		";
		$result = $TSunic->Db->doUpdate($sql);

		// update $this->info
		$this->info(true, true);

		return ($result) ? true : false;
	}

	/* create a new mailaccount
	 * @param string: email of mailaccount
	 * @param string: password of mailaccount
	 * +@param string: name of mailaccount
	 * +@param string: description of mailaccount
	 *
	 * @return bool
	 */
	public function create ($email, $password, $name = '', $description = '') {

		// validate input
		if (!$this->isValidName($name)
			or !$this->isValidDescription($description)
			or !$this->isValidEmail($email)
			or !$this->isValidPassword($password)
		) return false;

		// save in db
		global $TSunic;
		$sql = "INSERT INTO #__accounts
			SET fk_system_users__account = '".$TSunic->Usr->getInfo('id')."',
				_email_ = '$email',
				_password_ = '$password',
				_name_ = '$name',
				_description_ = '$description',
				dateOfCreation = NOW()
		";
		return $this->_create($sql);
	}

	/* edit a mailaccount
	 * @param string: email of mailaccount
	 * @param string: password of mailaccount
	 * +@param string: name of mailaccount
	 * +@param string: description of mailaccount
	 *
	 * @return bool
	 */
	public function edit ($email, $password, $name = '', $description = '') {

		// validate input
		if (!$this->isValidName($name)
				OR !$this->isValidDescription($description)
				OR !$this->isValidEmail($email)
				OR !$this->isValidPassword($password)
			) {
			return false;
		}

		// validate password
		$sql_set = array();
		if ($email != $this->getInfo('email'))
			$sql_set[] = "_email_ = '$email'";
		if (!empty($password) and $password != '*******')
			$sql_set[] = "_password_ = '$password'";
		if ($name != $this->getInfo('name'))
			$sql_set[] = "_name_ = '$name'";
		if ($description != $this->getInfo('description'))
			$sql_set[] = "_description_ = '$description'";
		if (empty($sql_set)) return true;

		// update database
		$sql = "UPDATE #__accounts SET ".
			implode(",", $sql_set).
			" WHERE id = '$this->id';";
		return $this->_edit($sql);
	}

	/* delete mail account
	 *
	 * @return bool
	 */
	public function delete () {

		// delete serverboxes
		$serverboxes = $this->getServerboxes();
		foreach ($serverboxes as $index => $value) {
			// delete imap
			$value->deleteServerbox();
		}

		// delete connection to smtps
		$smtps = $this->getSmtps();
		foreach ($smtps as $index => $value) {
			// delete smtp
			$value->editSmtp(0, true, true, true, true);
		}

		// delete in database
		$sql = "DELETE FROM #__accounts
			WHERE id = '$this->id';";
		return $this->_delete($sql);
	}

	/* check, if description of mail account is valid
	 * @param string: description of mail-account
	 *
	 * @return bool
	 */
	public function isValidDescription ($desc) {
		return (empty($desc) or $this->_validate($desc, 'string')
		) ? true : false;
	}

	/* check, if name of mail account is valid
	 * @param string: name of mail-account
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		return (empty($name) or $this->_validate($name, 'string')
		) ? true : false;
	}

	/* check, if email address of mail account is valid
	 * @param string: email of mail-account
	 *
	 * @return bool
	 */
	public function isValidEmail ($email) {
		return ($this->_validate($email, 'email')
		) ? true : false;
	}

	/* check, if password of mail-account is valid
	 * @param string: password of mail-account
	 *
	 * @return bool
	 */
	public function isValidPassword ($password) {

		// verify $this->info has been initialized
		$this->getInfo();

		// is password already set?
		if (!empty($this->password)) return true;

		// check, if empty password
		if (empty($password) OR $password == '********') return false;

		return true;
	}

	/* check, if host is valid
	 * @param string: host of server-connection
	 *
	 * @return bool
	 */
	public function isValidHost ($host) {
		return ($this->_validate($host, 'url')
		) ? true : false;
	}

	/* check, if port is valid
	 * @param string: port of server-connection
	 *
	 * @return bool
	 */
	public function isValidPort ($port) {
		return ($this->_validate($port, 'int')
		) ? true : false;
	}

	/* check, if user is valid
	 * @param string: user of server-connection
	 *
	 * @return bool
	 */
	public function isValidUser ($user) {
		return ($this->_validate($user, 'extString')
		) ? true : false;
	}

	/* get number or name of password-authentification
	 * @param string/int/bool: authentification-number or -name (false will use auth of this account)
	 * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
	 *
	 * @return int/string
	 */
	public function getAuth ($auth, $getNumber = false) {

		// get auth
		if (empty($auth)) $auth = $this->getInfo('auth');

		// convert and return
		return $this->convertNumberName($this->auths, $auth, $getNumber);
	}

	/* get number or name of connection-security
	 * @param string/int/bool: connsecurity-number or -name (false will use connsecurity of this account)
	 * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
	 *
	 * @return int/string
	 */
	public function getConnsecurity ($connsecurity, $getNumber = false) {

		// get auth
		if (empty($connsecurity)) $connsecurity = $this->getInfo('connsecurity');

		// convert and return
		return $this->convertNumberName($this->connsecurities, $connsecurity, $getNumber);
	}

	/* get number or name of protocol
	 * @param string/int/bool: protocol-number or -name (false will use protocol of this account)
	 * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
	 *
	 * @return int/string
	 */
	public function getProtocol ($protocol, $getNumber = false) {

		// get auth
		if (empty($protocol)) $protocol = $this->getInfo('protocol');

		// convert and return
		return $this->convertNumberName($this->protocols, $protocol, $getNumber);
	}

	/* convert from number to name or vice versa
	 * @param array: converter-array
	 * @param string/int: input-number or -name
	 * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
	 *
	 * @return int/string
	 */
	public function convertNumberName ($array, $input, $getNumber = false) {

		if (is_numeric($input)) {
			// is number

			// return number, if forced
			if ($getNumber === true) return $input;

			// get equivalent name
			if (isset($array[$input])) {
				// match!

				// return name or phrase?
				if ($getNumber == 'phrase') return $array[$input][1];
				return $array[$input][0];
			}

			// return empty
			return 0;
		} else {
			// is name

			// return name, if forced
			if ($getNumber === false) return $input;

			// try to get name
			foreach ($array as $index => $value) {
				if ($value[0] == $input) {
					// match!

					// return number or phrase?
					if ($getNumber == 'phrase') return $value[1];
					return $index;
				}
			}

			// return empty
			return '';
		}
	}

	/* ********************** interaction with server ******************* */

	/* get mailbox-connection-string
	 * +@param string/bool: name of box on server (false: no serverbox)
	 *
	 * @return string/bool
	 */
	protected function getMboxstr ($boxname = false) {

		// load data
		$protocol = $this->getProtocol(false, 'phrase');
		$auth = $this->getAuth(false, 'phrase');
		$connsecurity = $this->getConnsecurity(false, 'phrase');
		$host = $this->getInfo('host');
		$port = $this->getInfo('port');

		// validate data
		if (empty($host) OR empty($port) OR !is_numeric($port)) {
			return false;
		}

		// turn data in options
		$protocol = (!empty($protocol)) ? '/'.$protocol : '';
		$auth = (!empty($auth)) ? '/'.$auth : '';
		$connsecurity = (!empty($connsecurity)) ? '/'.$connsecurity : '';
		if (empty($boxname)) $boxname = '';

		// merge data to string
		$output = '{'.$host.':'.$port.$protocol.$auth.$connsecurity.'}'.$boxname;

		return $output;
	}

	/* connect to server
	 * +@param string/bool: name of box on server (false: no serverbox)
	 * +@param bool: set error?
	 *
	 * @return imap-stream
	 */
	public function getStream ($boxname = false, $setError = true) {
		global $TSunic;

		// check, if imap-functions exist
		if (!function_exists('imap_timeout')) {
			die('IMAP-functions are not supported by this server!');
			return false;
		}

		// get stream-index
		$stream_index = (empty($boxname)) ? '_all_' : $boxname;
		if (empty($boxname)) $boxname = '';

		// check, if connection already exists
		$stream = false;
		if (!isset($this->conn[$stream_index])) {

			// set timeout for opening and reading a connection
			imap_timeout(IMAP_OPENTIMEOUT, $this->timeout);
			imap_timeout(IMAP_READTIMEOUT, $this->timeout);

			// get mbox-string
			$mboxstr = $this->getMboxstr($boxname);
			if (!$mboxstr) return false;

			// try to connect
			$stream = imap_open($mboxstr, $this->info['user'], $this->password);

			// check, if imap-stream exist
			if ($setError AND !$stream) {
				// get error-msg
				$error = '{CLASS__ACCOUNT__NOCONNECTION}';
				$error.= ' (server: '.$this->info['host'].', user: '.$this->info['user'];
				if (!empty($boxname)) $error.= ', mailbox: '.$boxname;
				$error.= ')';

				// add error
				$TSunic->Log->alert('error', $error);
				$TSunic->Log->log(3, $error);
				return false;
			}
		}

		// return, if error occurred
		if (!$stream) return false;

		// save in obj-vars
		$this->conn[$stream_index] = $stream;

		// return
		return $this->conn[$stream_index];
	}

	/* close connection to server
	 * +@param string/bool: name of box on server (false: no serverbox)
	 *
	 * @return bool
	 */
	public function closeConnection ($boxname = false) {

		// get stream-index
		$stream_index = (empty($boxname)) ? $boxname = '_all_' : $boxname;

		// close connection
		if (isset($this->conn[$stream_index]) AND !empty($this->conn[$stream_index])) {
			@imap_close($this->conn[$stream_index]);
		}

		return true;
	}

	/* update local serverbox-list in database
	 *
	 * @return array/false
	 */
	public function updateServerboxes ($newOnly = false) {
		global $TSunic;

		// open connection
		$conn = $this->getStream();
		if (!$conn) return false;

		// get mbox-string
		$mboxstr = $this->getMboxstr();
		if (!$mboxstr) return false;

		// get serverboxes
		$serverboxes = imap_getmailboxes($conn, $mboxstr, '*');
		if (!is_array($serverboxes)) return false;

		// get locally added serverboxes
		$sql = "SELECT _name_ as name,
				id as id
			FROM #__serverboxes
			WHERE fk_mail__account = '".$this->id."';";
		$serverbox_list = $TSunic->Db->doSelect($sql);

		// get output-array
		$output = array();
		foreach ($serverboxes as $index => $values) {

			// get name of serverbox
			$name = utf8_encode(imap_utf7_decode($values->name));
			$name = preg_replace('!(\{(.*)\})!Usi', '', $name);

			// check, if already on list
			$isListed = false;
			foreach ($serverbox_list as $in => $val) {
				if ($val['name'] == $name) {
					// already in db
					$isListed = true;

					// delete from list
					unset($serverbox_list[$in]);
				}
			}

			if (!$isListed) {
				// add serverbox in db
				$Serverbox = $TSunic->get('$$$Serverbox');
				$Serverbox->createServerbox($this->id, $name);
			}
		}

		// set deleted serverboxes as deleted in database
		$sql_where = '';
		foreach ($serverbox_list as $index => $values) {
			$sql_where.= " OR id = '".$values['id']."'";
		}
		$sql_where = substr($sql_where, 3);

		if (strlen($sql_where) > 0) {
			$sql = "UPDATE #__serverboxes
				SET dateOfDeletion = NOW(),
					isActive = '0'
				WHERE ".$sql_where.";";
			$TSunic->Db->doUpdate($sql);
		}

		// set lastServerboxUpdate
		$sql = "UPDATE #__accounts
			SET lastServerboxUpdate = NOW()
			WHERE id = '".$this->id."';";
		return $TSunic->Db->doUpdate($sql);
	}

	/* try to get or validate connection-data automatically
	 * +@param string: host
	 * +@param int: port
	 * +@param string: user
	 * +@param int/bool: protocol
	 * +@param int/bool: password-authentification
	 * +@param int/bool: connection-security
	 *
	 * @return bool
	 */
	public function validateConnection ($host = false, $port = false, $user = false, $protocol = false, $auth = false, $connsecurity = false) {
		global $TSunic;

		// get input
		$protocol = (empty($protocol)) ? false : $this->getProtocol($protocol, true);
		$auth = (empty($auth)) ? false : $this->getAuth($auth, true);
		$connsecurity = (empty($connsecurity)) ? false : $this->getConnsecurity($connsecurity, true);

		// get assumed host-postfix and user
		$cache = explode('@', $this->getInfo('email'));
		if (count($cache) < 2) return false;
		$emailuser = trim($cache[0]);
		$suffix = trim($cache[1]);
		$host_lookup = ($this->isValidHost($host)) ? "OR host = '$host'" : '';

		// get matching entries from connection table
		$sql_protocol = ($protocol === false) ? '' : "protocol = '".$protocol."' AND ";
		$sql_auth = ($auth === false) ? '' : "auth = '".$auth."' AND ";
		$sql_connsecurity = ($connsecurity === false) ? '' : "connsecurity = '".$connsecurity."' AND ";
		$sql = "SELECT suffix as suffix,
				host as host,
				port as port,
				protocol as protocol,
				auth as auth,
				connsecurity as connsecurity,
				user as user
			FROM #__knownservers
			WHERE ".$sql_protocol.$sql_auth.$sql_connsecurity."
				suffix = '$suffix'
				OR suffix = ''
				".$host_lookup."
			ORDER BY suffix DESC, protocol ASC;";
		$result = $TSunic->Db->doSelect($sql);

		// check all possibilities until found right one
		$time_start = time();
		$checked_versions = array();
		foreach ($result as $index => $values) {

			// check for try-timeout (assumed php-timeout of 60s)
			$time_try = time() - $time_start;
			if ($time_try >= (59 - $this->timeout)) break;

			// set connection data
			$this->info['host'] = (empty($host)) ? str_replace('#suffix#', $suffix, $values['host']) : $host;
			$this->info['port'] = (empty($port)) ? $values['port'] : $port;
			$this->info['auth'] = (empty($auth)) ? $values['auth'] : $auth;
			$this->info['protocol'] = (empty($protocol)) ? $values['protocol'] : $protocol;
			$this->info['connsecurity'] = (empty($connsecurity)) ? $values['connsecurity'] : $connsecurity;
			$this->info['user'] = (($values['user'] == 2)) ? $this->getInfo('email') : $emailuser;
			if (!empty($user)) $this->info['user'] = $user;

			// already checked these settings?
			foreach ($checked_versions as $in => $val) {
				if ($val == $this->info) continue 2;
			}

			// try to connect
			if ($this->getStream(false, false)) {
				// connected!
				return true;
			}

			// add settings to $checked_versions
			$checked_versions[] = $this->info;
		}

		// no connection found
		return false;
	}
}
?>
