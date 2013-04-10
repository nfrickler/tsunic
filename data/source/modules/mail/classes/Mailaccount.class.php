<!-- | CLASS Mailaccount -->
<?php
class $$$Mailaccount extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = "#__$mail$mailaccounts";

    /* serverbox objects
     * array
     */
    protected $serverboxes;

    /* time in seconds after local serverbox information has to be updated
     * int
     */
    protected $frequenceServerboxUpdate;

    /* ImapServer object
     * object
     */
    protected $ImapServer;

    /* password authentifications
     * array
     */
    protected $auths = array(
	1 => array('{CLASS__MAILACCOUNT__AUTHS_NORMAL}', ''),
	2 => array('{CLASS__MAILACCOUNT__AUTHS_ENCRYPTEDPWD}', 'secure'),
	//   3 => array('{CLASS__MAILACCOUNT__AUTHS_NTLM}', ''), // not supported
	//   4 => array('{CLASS__MAILACCOUNT__AUTHS_KERBEROS_GSSAPI}', '') // not supported
    );

    /* protocols
     * array
     */
    protected $protocols = array(
	1 => array('{CLASS__MAILACCOUNT__PROTOCOLS_IMAP}', 'imap'),
	2 => array('{CLASS__MAILACCOUNT__PROTOCOLS_POP3}', 'pop3')
    );

    /* connections-securities
     * array
     */
    protected $connsecurities = array(
	1 => array('{CLASS__MAILACCOUNT__CONNSECURITIES_NONE}', 'novalidate-cert'),
	2 => array('{CLASS__MAILACCOUNT__CONNSECURITIES_STARTTLS}', 'tls/novalidate-cert'),
	3 => array('{CLASS__MAILACCOUNT__CONNSECURITIES_SSLTLS}', 'ssl'),
	4 => array('{CLASS__MAILACCOUNT__CONNSECURITIES_SSLTLSNOVAL}', 'ssl/novalidate-cert')
    );

    /* imap timeout (in seconds)
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

    /* get all serverboxes of this server
     * @param bool: allow update of serverboxes?
     *
     * @return array
     */
    public function getServerboxes ($allowSync = true) {
	if (!$this->isValid()) return array();
	if (!empty($this->serverboxes)) return $this->serverboxes;
	global $TSunic;

	// get serverboxes from database
	$sql = "SELECT id
		FROM #__$mail$serverboxes
		WHERE fk_mailaccount = '".$this->id."';";
	$result = $TSunic->Db->doSelect($sql);

	// get serverbox objects
	$this->serverboxes = array();
	foreach ($result as $index => $values) {
	    $this->serverboxes[] = $TSunic->get('$$$Serverbox', $values['id']);
	}

	// if no serverboxes found, try to update serverboxes
	if ($allowSync and empty($this->serverboxes)) {
	    $this->updateServerboxes();
	    return $this->getServerboxes(false);
	}

	return $this->serverboxes;
    }

    /* get all available connection security options
     *
     * @return array
     */
    public function getAllConnsecurities () {
	return $this->connsecurities;
    }

    /* get all available password authentication options
     *
     * @return array
     */
    public function getAllAuths () {
	return $this->auths;
    }

    /* get all available protocol options
     *
     * @return array
     */
    public function getAllProtocols () {
	return $this->protocols;
    }

    /* set connection for mailaccount
     * @param string: host to connect to mailaccount
     * @param string: user to connect to mailaccount
     * @param int: port to connect to mailaccount
     * @param int/string: protocol
     * @param int/string: password authentification
     * @param int/string: connection security
     *
     * @return bool
     */
    public function setConnection (
	$host, $port, $user, $protocol, $auth, $connsecurity
    ) {

	// validate input
	if (!$this->isValidHost($host)
	    or !$this->isValidUser($user)
	    or !$this->isValidPort($port)
	) return false;

	// udpate database
	$data = array(
	    "host" => $host,
	    "user" => $user,
	    "port" => $port,
	    "protocol" => $this->getProtocol($protocol, true),
	    "auth" => $this->getAuth($auth, true),
	    "connsecurity" => $this->getConnsecurity($connsecurity, true),
	);
	return $this->setMulti($data, true);
    }

    /* try to detect right connection data and save them
     * +@param string: host
     * +@param int: port
     * +@param string: user
     * +@param int/bool: protocol
     * +@param int/bool: password authentification
     * +@param int/bool: connection security
     *
     * @return bool
     */
    public function setAutoConnection (
	$host = false, $port = false, $user = false, $protocol = false,
	$auth = false, $connsecurity = false
    ) {

	// detect connection
	$Server = $this->detectConnection(
	    $host, $port, $user, $protocol, $auth, $connsecurity
	);
	if (!$Server) return false;

	// save detected connection
	if (!$this->setConnection(
	    $Server->getInfo('host'),
	    $Server->getInfo('port'),
	    $Server->getInfo('user'),
	    $Server->getInfo('protocol'),
	    $Server->getInfo('auth'),
	    $Server->getInfo('connsecurity')
	)) return false;

	return true;
    }

    /* checks wether a value of this object is valid
     * @param string: name of value
     * @param string: value
     *
     * @return bool
     */
    public function isValidInfo ($name, $value) {

	switch ($name) {
	    case 'host':
		if (!$this->isValidHost($value)) return false;
		break;
	    case 'port':
		if (!$this->isValidPort($value)) return false;
		break;
	    case 'user':
		if (!$this->isValidUser($value)) return false;
		break;
	    case 'auth':
		if (!$this->isValidAuth($value)) return false;
		break;
	    case 'connsecurity':
		if (!$this->isValidConnsecurity($value)) return false;
		break;
	    case 'name':
		if (!$this->isValidName($value)) return false;
		break;
	    case 'description':
		if (!$this->isValidDescription($value)) return false;
		break;
	    case 'email':
		if (!$this->isValidEmail($value)) return false;
		break;
	    case 'password':
		if (!$this->isValidPassword($value)) return false;
		break;
	}

	return parent::isValidValue($name, $value);;
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

	// name defaults to email
	if (empty($name)) $name = $email;

	// save in db
	global $TSunic;
	$data = array(
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "email" => $email,
	    "password" => $password,
	    "name" => $name,
	    "description" => $description,
	    "dateOfCreation" => "NOW()"
	);
	return $this->_create($data);
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

	// name defaults to email
	if (empty($name)) $name = $email;

	// update database
	$data = array(
	    "name" => $name,
	    "email" => $email,
	    "password" => $password,
	    "description" => $description
	);
	return $this->setMulti($data);
    }

    /* delete mail account
     *
     * @return bool
     */
    public function delete () {

	// delete serverboxes
	$serverboxes = $this->getServerboxes();
	foreach ($serverboxes as $index => $value) {
	    $value->delete();
	}

	// delete in database
	return $this->_delete();
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
	return (empty($name) or $this->_validate($name, 'extString')
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
	$old_password = $this->getInfo('password');
	if (!empty($old_password)) return true;

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
	if ($auth === false) $auth = $this->getInfo('auth');

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
	if ($connsecurity === false)
	    $connsecurity = $this->getInfo('connsecurity');

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
	if ($protocol === false) $protocol = $this->getInfo('protocol');

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

	if (!empty($input) and is_numeric($input)) {
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

		if ($value[1] == $input) {
		    // match!

		    // return number or phrase?
		    if ($getNumber === 'phrase') return $value[0];
		    return $index;
		}
	    }

	    // return empty
	    return '';
	}
    }

    /* ********************** interaction with server ******************* */

    /* get ImapServer object
     *
     * @return object
     */
    public function getServer () {
	if ($this->ImapServer) return $this->ImapServer;
	global $TSunic;

	$this->ImapServer = $TSunic->get('$$$ImapServer', array(
	    $this->getInfo('host'),
	    $this->getInfo('port'),
	    $this->getInfo('user'),
	    $this->getInfo('password'),
	    $this->getProtocol($this->getInfo('protocol'), 'phrase'),
	    $this->getAuth($this->getInfo('auth'), 'phrase'),
	    $this->getConnsecurity($this->getInfo('connsecurity'), 'phrase')
	));

	return $this->ImapServer;
    }


    /* update local serverbox list in database
     *
     * @return array/false
     */
    public function updateServerboxes () {
	global $TSunic;

	// get remote serverboxes
	$Server = $this->getServer();
	if (!$Server) return false;
	$rboxes = $Server->getServerboxes();
	if ($rboxes === false) return false;

	// get local serverboxes
	$lboxes = $this->getServerboxes(false);

	// delete old mailboxes
	foreach ($lboxes as $index => $Value) {
	    if (in_array($Value->getInfo('name'),$rboxes)) continue;

	    // delete mailbox
	    $Value->delete();
	}

	// add new mailboxes
	foreach ($rboxes as $index => $value) {
	    $exists = 0;
	    foreach ($lboxes as $in => $Val) {
		if ($Val->getInfo('name') == $value) {
		    $exists = 1;
		    break;
		}
	    }
	    if ($exists) continue;

	    // create new Serverbox
	    $Serverbox = $TSunic->get('$$$Serverbox');
	    $Serverbox->create($this->id, $value);
	}

	return true;
    }

    /* try to get or validate connection data automatically
     * +@param string: host
     * +@param int: port
     * +@param string: user
     * +@param int/bool: protocol
     * +@param int/bool: password authentification
     * +@param int/bool: connection security
     *
     * @return object
     */
    public function detectConnection (
	$host = false, $port = false, $user = false, $protocol = false,
	$auth = false, $connsecurity = false
    ) {
	global $TSunic;

	// get input
	$protocol = (empty($protocol)) ? false : $this->getProtocol($protocol, true);
	$auth = (empty($auth)) ? false : $this->getAuth($auth, true);
	$connsecurity = (empty($connsecurity)) ? false : $this->getConnsecurity($connsecurity, true);

	// get assumed host postfix and user
	$cache = explode('@', $this->getInfo('email'));
	if (count($cache) < 2) return NULL;
	$emailuser = trim($cache[0]);
	$suffix = trim($cache[1]);
	$host_lookup = ($this->isValidHost($host)) ? "OR host = '$host'" : '';

	// get matching entries from connection table in database
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
		FROM #__$mail$knownservers
		WHERE ".$sql_protocol.$sql_auth.$sql_connsecurity."
		    suffix = '$suffix'
		    OR suffix = ''
		    $host_lookup
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
	    $con_data = array();
	    $con_data['host'] = (empty($host))
		? str_replace('#suffix#', $suffix, $values['host'])
		: $host;
	    $con_data['port'] = (empty($port)) ? $values['port'] : $port;
	    $con_data['auth'] = (empty($auth)) ? $values['auth'] : $auth;
	    $con_data['protocol'] = (empty($protocol))
		? $values['protocol'] : $protocol;
	    $con_data['connsecurity'] = (empty($connsecurity))
		? $values['connsecurity'] : $connsecurity;
	    $con_data['user'] = (($values['user'] == 2))
		? $this->getInfo('email') : $emailuser;
	    if (!empty($user)) $con_data['user'] = $user;

	    // already checked these settings?
	    foreach ($checked_versions as $in => $val) {
		if ($val == $con_data) continue 2;
	    }

	    // try to connect
	    $Server = $TSunic->get('$$$ImapServer', array(
		$con_data['host'],
		$con_data['port'],
		$con_data['user'],
		$this->getInfo('password'),
		$this->getProtocol($con_data['protocol'], 'phrase'),
		$this->getAuth($con_data['auth'], 'phrase'),
		$this->getConnsecurity(
		    $con_data['connsecurity'], 'phrase'
		),
		$this->timeout,
	    ));
	    if ($Server->isValid()) {
		return $Server;
	    }

	    // add settings to $checked_versions
	    $checked_versions[] = $con_data;
	}

	// no connection found
	return NULL;
    }
}
?>
