<!-- | mail account class -->
<?php
class $$$Account {

	/* id of mail-account
	 * string
	 */
	private $id_mail__account;

	/* information about mail-account
	 * array
	 */
	private $info;

	/* smtp-objects
	 * array
	 */
	private $smtps;

	/* serverbox-objects
	 * array
	 */
	private $serverboxes = array();

	/* password of mailaccount
	 * string
	 */
	private $password;

	/* time in seconds after local serverbox-information has to be updated 
	 * int
	 */
	private $frequenceServerboxUpdate;

	/* password-authentifications
	 * array
	 */
	private $auths = array(
		1 => array('{CLASS__ACCOUNT__AUTHS_NORMAL}', ''),
		2 => array('{CLASS__ACCOUNT__AUTHS_ENCRYPTEDPWD}', 'secure'),
		//   3 => array('{CLASS__ACCOUNT__AUTHS_NTLM}', ''), // not supported
		//   4 => array('{CLASS__ACCOUNT__AUTHS_KERBEROS_GSSAPI}', '') // not supported
	);

	/* protocols
	 * array
	 */
	private $protocols = array(
		1 => array('{CLASS__ACCOUNT__PROTOCOLS_IMAP}', 'imap'),
		2 => array('{CLASS__ACCOUNT__PROTOCOLS_POP3}', 'pop3')
	);

	/* connections-securities
	 * array
	 */
	private $connsecurities = array(
		1 => array('{CLASS__ACCOUNT__CONNSECURITIES_NONE}', 'novalidate-cert'),
		2 => array('{CLASS__ACCOUNT__CONNSECURITIES_STARTTLS}', 'tls/novalidate-cert'),
		3 => array('{CLASS__ACCOUNT__CONNSECURITIES_SSLTLS}', 'ssl'),
		4 => array('{CLASS__ACCOUNT__CONNSECURITIES_SSLTLSNOVAL}', 'ssl/novalidate-cert')
	);

	/* imap-timeout (in seconds)
	 * int
	 */
	private $timeout = 3;

	/* constructor
	 * +@params int: id_mail__account
	 */
	public function __construct ($id_mail__account = 0) {

		// save id
		$this->id_mail__account = $id_mail__account;

		// set $frequenceServerboxUpdate
		$this->frequenceServerboxUpdate = 60 * 60 * 24 * 7;

		return;
	}

	/* get all data of mail-account
	 * +@param bool/string: name of data (true will return all data)
	 *
	 * @return array/false
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if info already in cache
		if (!empty($this->id_mail__account) AND empty($this->info)) {

			// get data from database
			$sql_0 = "SELECT _name_ as name,
					 _description_ as description,
					 dateOfCreation as dateOfCreation,
					 dateOfUpdate as dateOfUpdate,
					 _email_ as email,
					 _password_ as password,
					 _host_ as host,
					 _user_ as user,
					 _port_ as port,
					 protocol as protocol,
					 connsecurity as connsecurity,
					 auth as auth,
					 lastServerboxUpdate as lastServerboxUpdate
				FROM #__accounts
				WHERE id_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// return, if no server matched
			if (empty($result_0)) return false;

			// move password to obj-var
			$this->password = $result_0[0]['password'];
			unset($result_0[0]['password']);

			// store data
			$this->info = $result_0[0];
			$this->info['id_mail__account'] = $this->id_mail__account;
			if (!empty($this->password)) $this->info['password'] = '********';

			// set e-mail as name, if name is not set
			if (empty($this->info['name'])) $this->info['name'] = $this->info['email'];
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* update info-data
	 *
	 * @return true
 	 */
	protected function updateInfo () {

		// reset info
		$this->info = array();

		// get current info
		return $this->getInfo();
	}

	/* get all serverboxes of this server
	 *
	 * @return array
 	 */
	public function getServerboxes () {
		global $TSunic;

		// already computed OR invalid account?
		if (!$this->isValid() OR !empty($this->serverboxes)) return $this->serverboxes;

		// get timestamp from mysql-datetime (TODO: exclude in time-class)
		list($date, $time) = explode(' ', $this->getInfo('lastServerboxUpdate'));
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);
		$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

		// update serverboxes?
		$timesince = time() - $timestamp;
		if ($timesince >= $this->frequenceServerboxUpdate) $this->updateServerboxes();

		// get serverboxes from database
		$sql_0 = "SELECT id_mail__serverbox as id_mail__serverbox
				FROM #__serverboxes
				WHERE fk_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// get serverbox-objects
		$this->serverboxes = array();
		foreach ($result_0 as $index => $values) {
			// get serverobject
			$this->serverboxes[] = $TSunic->get('$$$Serverbox', $values['id_mail__serverbox']);
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
		global $TSunic;

		if (empty($this->smtps)) {

			// get smtps from database
			$sql_0 = "SELECT id_mail__smtp as id_mail__smtp
					FROM #__smtps
					WHERE fk_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// get objects
			$this->smtps = array();
			foreach ($result_0 as $index => $values) {
				// get object
				$this->smtps[] = $TSunic->get('$$$Smtp', $values['id_mail__smtp']);
			}
		}

		return $this->smtps;
	}

	/* set connection for mail-account
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

		// is valid connection?
		if (!$this->validateConnection($host, $port, $user, $protocol, $connsecurity, $auth)) {
			// invalid connection data
			return false;
		}

		// update connection-data
		$host = $this->info['host'];
		$port = $this->info['port'];
		$user = $this->info['user'];
		$protocol = $this->info['protocol'];
		$connsecurity = $this->info['connsecurity'];
		$auth = $this->info['auth'];

		// validate input
		if (!$this->isValidHost($host)
				OR !$this->isValidUser($user)
				OR !$this->isValidPort($port)
			) {
			// invalid input-data
			return false;
		}

		// save in db
		$sql_0 = "UPDATE #__accounts
				SET _host_ = '".mysql_real_escape_string($host)."',
					_user_ = '".mysql_real_escape_string($user)."',
					_port_ = '".mysql_real_escape_string($port)."',
					protocol = '".$this->getProtocol($protocol, true)."',
					connsecurity = '".$this->getConnsecurity($connsecurity, true)."',
					auth = '".$this->getAuth($auth, true)."'
				WHERE id_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';
				";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		if ($result_0) return true;
		return false;
	}

	/* create a new mail-account
	 * @param string: email of mail-account
	 * @param string: password of mail-account
	 * +@param string: name of mail-account
	 * +@param string: description of mail-account
	 *
	 * @return bool
 	 */
	public function createAccount ($email, $password, $name = '', $description = '') {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name)
				OR !$this->isValidDescription($description)
				OR !$this->isValidEmail($email)
				OR !$this->isValidPassword($password)
			) {
			// invalid input-data
			return false;
		}

		// save in db
		$sql_0 = "INSERT INTO #__accounts
				SET fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."',
				_email_ = '".mysql_real_escape_string($email)."',
				_password_ = '".mysql_real_escape_string($password)."',
				_name_ = '".mysql_real_escape_string($name)."',
				_description_ = '".mysql_real_escape_string($description)."',
				dateOfCreation = NOW()
				";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->id_mail__account = mysql_insert_id();
		$this->updateInfo();

		return $result_0;
	}

	/* edit a mail-account
	 * @param string: email of mail-account
	 * @param string: password of mail-account
	 * +@param string: name of mail-account
	 * +@param string: description of mail-account
	 *
	 * @return bool
 	 */
	public function editAccount ($email, $password, $name = '', $description = '') {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name)
				OR !$this->isValidDescription($description)
				OR !$this->isValidEmail($email)
				OR !$this->isValidPassword($password)
			) {
			// invalid input-data
			return false;
		}

		// validate password
		$sql_password = '';
		if ($password != '********' AND !empty($password)) {
			// create sql-string for password
			$sql_password = "_password_ = '".mysql_real_escape_string($password)."',";
		}

		// save in db
		$sql_0 = "UPDATE #__accounts
				SET fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."',
					_email_ = '".mysql_real_escape_string($email)."',
					".$sql_password."
					_name_ = '".mysql_real_escape_string($name)."',
					_description_ = '".mysql_real_escape_string($description)."',
					dateOfCreation = NOW()
				WHERE id_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';
				";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		if ($result_0) return true;
		return false;
	}

	/* delete this mail-account
	 *
	 * @return bool
 	 */
	public function deleteAccount () {
		global $TSunic;

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

		// delete account in database
		$sql_0 = "DELETE FROM #__accounts
				  WHERE id_mail__account = '".mysql_real_escape_string($this->id_mail__account)."'
				  ;";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		return true;
	}

	/* check, if name of mail-account is valid
	 * @param string: description of mail-account
	 *
	 * @return bool
 	 */
	public function isValidDescription ($description) {
		return true;
	}

	/* check, if name of mail-account is valid
	 * @param string: name of mail-account
	 *
	 * @return bool
 	 */
	public function isValidName ($name) {

		return true;
	}

	/* check, if email-address of mail-account is valid
	 * @param string: email of mail-account
	 *
	 * @return bool
 	 */
	public function isValidEmail ($email) {

		// check, if empty password
		if (empty($email)) return false;

		return true;
	}

	/* check, if password of mail-account is valid
	 * @param string: password of mail-account
	 *
	 * @return bool
 	 */
	public function isValidPassword ($password) {

		// verify $this->info has been initialized
		$this->updateInfo();

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

		// check, if string is empty
		if (empty($host)) return false;

		return true;
	}

	/* check, if port is valid
	 * @param string: port of server-connection
	 *
	 * @return bool
 	 */
	public function isValidPort ($port) {

		// verify int
		$port = (int) $port;

		// check, if string is empty
		if (empty($port) OR !is_numeric($port)) return false;

		return true;
	}

	/* check, if user is valid
	 * @param string: user of server-connection
	 *
	 * @return bool
 	 */
	public function isValidUser ($user) {

		// check, if string is empty
		if (empty($user)) return false;

		return true;
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

	/* check, if mailaccount exists
	 *
	 * @return bool
 	 */
	public function isValid () {

		// check, if id exists
		if (!isset($this->id_mail__account) OR empty($this->id_mail__account))
			return false;

		// check, if mailaccount in database
		$dateOfCreation = $this->getInfo('dateOfCreation');
		if (empty($dateOfCreation)) return false;

		return true;
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
			@imap_timeout(IMAP_OPENTIMEOUT, $this->timeout);
			@imap_timeout(IMAP_READTIMEOUT, $this->timeout);

			// get mbox-string
			$mboxstr = $this->getMboxstr($boxname);
			if (!$mboxstr) return false;

			// try to connect
			$stream = @imap_open($mboxstr, $this->info['user'], $this->password);

			// check, if imap-stream exist
			if ($setError AND !$stream) {
				// get error-msg
				$error = '{CLASS__ACCOUNT__NOCONNECTION}';
				$error.= ' (server: '.$this->info['host'].', user: '.$this->info['user'];
				if (!empty($boxname)) $error.= ', mailbox: '.$boxname;
				$error.= ')';

				// add error
				$TSunic->Log->add('error', $error);
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
		$sql_0 = "SELECT _name_ as name,
					id_mail__serverbox as id_mail__serverbox
				FROM #__serverboxes
				WHERE fk_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';";
		$serverbox_list = $TSunic->Db->doSelect($sql_0);

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
				$Serverbox->createServerbox($this->id_mail__account, $name);
			}
		}

		// set deleted serverboxes as deleted in database
		$sql_where = '';
		foreach ($serverbox_list as $index => $values) {
			$sql_where.= " OR id_mail__serverbox = '".mysql_real_escape_string($values['id_mail__serverbox'])."'";
		}
		$sql_where = substr($sql_where, 3);

		if (strlen($sql_where) > 0) {
			$sql_2 = "UPDATE #__serverboxes
					SET dateOfDeletion = NOW(),
						isActive = '0'
					WHERE ".$sql_where.";";
			$result_2 = $TSunic->Db->doUpdate($sql_2);
		}

		// set lastServerboxUpdate
		$sql_3 = "UPDATE #__accounts
				SET lastServerboxUpdate = NOW()
				WHERE id_mail__account = '".mysql_real_escape_string($this->id_mail__account)."';";
		$result_3 = $TSunic->Db->doUpdate($sql_3);

		return true;
	}

	/* try to get or validate connection-data automatically
	 * @param string: host
	 * @param int: port
	 * @param string: user
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
		$email = $this->getInfo('email');
		$cache = explode('@', $email);
		if (count($cache) < 2) return false;
		$emailuser = trim($cache[0]);
		$suffix = trim($cache[1]);
		$host_lookup = (!empty($host)) ? "OR host = '".mysql_real_escape_string($host)."'" : '';

		// get matching entries from connection table
		$sql_protocol = ($protocol === false) ? '' : "protocol = '".$protocol."' AND ";
		$sql_auth = ($auth === false) ? '' : "auth = '".$auth."' AND ";
		$sql_connsecurity = ($connsecurity === false) ? '' : "connsecurity = '".$connsecurity."' AND ";
		$sql_0 = "SELECT suffix as suffix,
					host as host,
					port as port,
					protocol as protocol,
					auth as auth,
					connsecurity as connsecurity,
					user as user
				FROM #__knownservers
				WHERE ".$sql_protocol.$sql_auth.$sql_connsecurity."
					suffix = '".mysql_real_escape_string($suffix)."'
					OR suffix = ''
					".$host_lookup."
				ORDER BY suffix DESC, protocol ASC;";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// check all possibilities until found right one
		$time_start = time();
		$checked_versions = array();
		foreach ($result_0 as $index => $values) {

			// check for try-timeout (assumed php-timeout of 60s)
			$time_try = time() - $time_start;
			if ($time_try >= (59 - $this->timeout)) break;

			// set connection data
			$this->info['host'] = (empty($host)) ? str_replace('#suffix#', $suffix, $values['host']) : $host;
			$this->info['port'] = (empty($port)) ? $values['port'] : $port;
			$this->info['auth'] = (empty($auth)) ? $values['auth'] : $auth;
			$this->info['protocol'] = (empty($protocol)) ? $values['protocol'] : $protocol;
			$this->info['connsecurity'] = (empty($connsecurity)) ? $values['connsecurity'] : $connsecurity;
			$this->info['user'] = (($values['user'] == 2)) ? $email : $emailuser;
			if (!empty($user)) $this->info['user'] = $user;

			// already checked these settings?
			foreach ($checked_versions as $in => $val) {
				if ($val == $this->info) {
					continue 2;
				}
			}

			// try to connect...
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
