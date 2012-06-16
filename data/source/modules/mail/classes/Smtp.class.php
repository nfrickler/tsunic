<!-- | CLASS Smtp -->
<?php
include_once '$system$Object.class.php';
class $$$Smtp extends $system$Object {

    /* password for smtp-server
     * string
     */
    private $password;

    /* Mailaccount object
     * object
     */
    protected $Mailaccount;

    /* timeout for SMTP connection in seconds
     * int
     */
    protected $timeout = 5;

    /* password-authentifications
     * array
     */
    protected $auths = array(
	1 => array('{CLASS__SMTP__AUTHS_NORMAL}', ''),
	2 => array('{CLASS__SMTP__AUTHS_ENCRYPTEDPWD}', 'secure'),
	//  3 => array('{CLASS__SMTP__AUTHS_NTLM}', ''), // not supported
	//  4 => array('{CLASS__SMTP__AUTHS_KERBEROS_GSSAPI}', ''), // not supported
	5 => array('{CLASS__SMTP__AUTHS_NOAUTH}', '')
    );

    /* connections securities
     * array
     */
    protected $connsecurities = array(
	1 => array('{CLASS__SMTP__CONNSECURITIES_NONE}', ''),
	2 => array('{CLASS__SMTP__CONNSECURITIES_STARTTLS}', ''),
	3 => array('{CLASS__SMTP__CONNSECURITIES_SSLTLS}', 'tls')
    );

    /* load infos from database
     *
     * @return sql query
     */
    protected function loadInfoSql () {
	return "SELECT _emailname_ as emailname,
		_description_ as description,
		dateOfCreation,
		dateOfUpdate,
		_email_ as email,
		_password_ as password,
		_host_ as host,
		_port_ as port,
		_user_ as user,
		connsecurity,
		auth,
		fk_mailaccount,
		fk_account
	    FROM #__smtps
	    WHERE id = '$this->id';";
    }

    /* load information about object
     */
    protected function loadInfo () {
	$return = parent::loadInfo();

	// handle password
	if ($this->info['password']) {
	    $this->password = $this->info['password'];
	    unset($this->info['password']);
	}

	return $return;
    }

    /* get Mailaccount object connected to smtp-server
     * +@param bool: get id instead of object
     *
     * @return OBJECT/bool
     */
    public function getMailaccount ($get_id = false) {

	// is already in obj-vars?
	if (isset($this->Mailaccount) AND !empty($this->Mailaccount))
	    return ($get_id) ? $this->Mailaccount->getInfo('id') : $this->Mailaccount;

	// try to get fk_mailaccount
	$fk_mailaccount = $this->getInfo('fk_mailaccount');
	if (empty($fk_mailaccount)) return false;

	// try to get object
	global $TSunic;
	$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mailaccount);
	if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

	// save in obj-var and return
	$this->Mailaccount = $Mailaccount;
	return ($get_id) ? $this->Mailaccount->getInfo('id') : $this->Mailaccount;
    }

    /* set mailaccount
     * @param object: mailaccount object
     *
     * @return bool
     */
    public function setMailaccount ($Mailaccount) {
	global $TSunic;

	// is valid account?
	if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

	// is new mailaccount?
	if ($Mailaccount->getInfo('id') == $this->getInfo('fk_mailaccount'))
	    return true;

	// save in obj-var
	$this->Mailaccount = $Mailaccount;

	// is Smtp object
	if (!$this->isValid()) {

	    // presets
	    $this->info['email'] = $Mailaccount->getInfo('email');

	    return true;
	}

	// update database
	$sql = "UPDATE #__smtps
		SET fk_mailaccount = ".$this->Mailaccount->getInfo('id')."
		WHERE id = ".$this->id.";";
	$result = $TSunic->Db->doUpdate($sql);

	return true;
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

    /* get number or name of password-authentification
     * +@param string/int/bool: authentification-number or -name (false will use auth of this object)
     * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
     *
     * @return int/string
     */
    public function getAuth ($auth = false, $getNumber = false) {

	// get auth
	if ($auth == false) $auth = $this->getInfo('auth');

	// convert and return
	return $this->convertNumberName($this->auths, $auth, $getNumber);
    }

    /* get number or name of connection-security
     * +@param string/int/bool: connsecurity-number or -name (false will use consecurity of this object)
     * +@param bool/string: force output to be number (true) or name (false) or phrase ('phrase')
     *
     * @return int/string
     */
    public function getConnsecurity ($connsecurity = false, $getNumber = false) {

	// get connsecurity
	if ($connsecurity == false) $connsecurity = $this->getInfo('connsecurity');

	// convert and return
	return $this->convertNumberName($this->connsecurities, $connsecurity, $getNumber);
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

    /* create new smtp-server
     * @param string: email-address
     * @param string: password
     * +@param string: description
     * +@param string: email-name
     *
     * @return bool
     */
    public function create ($email, $password, $description = false, $emailname = false) {

	// validate input
	if (!$this->isValidEMail($email)
	    OR !$this->isValidPassword($password)
	    OR !$this->isValidDescription($description)
	    OR !$this->isValidEMailname($emailname)
	) return false;

	// create new server in database
	global $TSunic;
	$sql = "INSERT INTO #__smtps
		SET _email_ = '".$email."',
		    _password_ = '".$password."',
		    _description_ = '".$description."',
		    _emailname_ = '".$emailname."',
		    fk_account = '".$TSunic->Usr->getInfo('id')."',
		    dateOfCreation = NOW()
	;";
	return $this->_create($sql);
    }

    /* set connection for smtp-server
     * @param string: host to connect to smtp server
     * @param string: user to connect to smtp server
     * @param int: port to connect to smtp server
     * @param int/string: connection-security
     * @param int/string: password-authentification
     *
     * @return bool
     */
    public function setConnection ($host, $port, $user, $connsecurity, $auth) {

	// validate input
	if (!$this->isValidHost($host)) $host = false;
	if (!$this->isValidPort($port)) $port = false;
	if (!$this->isValidAuth($auth)) $auth = false;
	if (!$this->isValidUser($user)) $user = false;
	if (!$this->isValidConnsecurity($connsecurity)) $connsecurity = false;

	// is valid connection?
	if (!$this->validateConnection($host, $port, $user, $connsecurity, $auth)) {
	    // invalid connection data
	    return false;
	}

	// save in db
	global $TSunic;
	$sql = "UPDATE #__smtps
		SET _host_ = '".$this->getInfo('host')."',
		    _user_ = '".$this->getInfo('user')."',
		    _port_ = '".$this->getInfo('port')."',
		    connsecurity = '".$this->getConnsecurity($this->getInfo('connsecurity'), true)."',
		    auth = '".$this->getAuth($this->getInfo('auth'), true)."'
		WHERE id = '".$this->id."';
	";

	$result = $TSunic->Db->doUpdate($sql);

	// update object
	$this->loadInfo();

	return ($result) ? true : false;
    }

    /* edit smtp-server
     * @param string: email-address
     * @param string: password
     * +@param string: description
     * +@param string: email-name
     *
     * @return bool
     */
    public function edit ($email, $password, $description = '', $emailname = '') {

	// validate input
	if (!$this->isValidEMail($email)
	    OR !$this->isValidPassword($password)
	    OR !$this->isValidDescription($description)
	    OR !$this->isValidEMailname($emailname)
	) return false;

	// get sql-query-string
	$sql_set = array();
	if ($email != $this->getInfo('email'))
	    $sql_set[] = "_email_ = '$email'";
	if ($description != $this->getInfo('description'))
	    $sql_set[] = "_description_= '$description'";
	if ($emailname != $this->getInfo('emailname'))
	    $sql_set[] = "_emailname_ = '$emailname'";
	if (!empty($password) and $password != '**********')
	    $sql_set[] = "_password_ = '$password'";
	if (!$sql_set) return true;

	// update database
	$sql = "UPDATE #__smtps
		SET ".implode(',', $sql_set)."
		WHERE id = '".$this->id."' ;";
	return $this->_edit($sql);
    }

    /* delete smtp-server
     *
     * @return bool
     */
    public function deleteSmtp () {
	$sql = "DELETE FROM #__smtps
		WHERE id = '".$this->id."';";
	return $this->_delete($sql);
    }

    /* check, if fk_mailaccount is valid
     * @param int: fk of mail account
     *
     * @return bool
     */
    public function isValidFkmailaccount ($fk) {
	return $this->_isObject('#__mailaccounts', $fk);
    }

    /* check, if host is valid
     * @param string: host of server-connection
     *
     * @return bool
     */
    public function isValidHost ($host) {
	return $this->_validate($host, 'url');
    }

    /* check, if description is valid
     * @param string: description
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description) or $this->_validate($description, 'string'));
    }

    /* check, if port is valid
     * @param string: port of server-connection
     *
     * @return bool
     */
    public function isValidPort ($port) {
	return (empty($port) or $this->_validate($port, 'int'));
    }

    /* check, if auth is valid
     * @param int: security
     *
     * @return bool
     */
    public function isValidAuth ($auth) {
	return isset($this->auths[$auth]);
    }

    /* check, if connsecurity is valid
     * @param int: connsecurity
     *
     * @return bool
     */
    public function isValidConnsecurity ($connsecurity) {
	return (isset($this->connsecurities[$auth])) ? true : false;
    }

    /* get possible auths ($auth = true) OR name of one auth ($auth = int) OR authname of this object ($auth = false)
     * +@param int/bool: security
     *
     * @return int/array
     */
    public function getAuthname ($auth = false) {

	// get $auth of current object (if requested)
	if ($auth === false) $auth = $this->getInfo('auth');

	// check, if return all
	if ($auth === true) return $this->auth_all;

	// try to return authname
	if (isset($this->auth_all[$auth])) return $this->auth_all[$auth];

	return false;
    }

    /* check, if user is valid
     * @param string: user of server-connection
     *
     * @return bool
     */
    public function isValidUser ($user) {
	return $this->_validate($user, 'extString');
    }

    /* check, if password is valid
     * @param string: password of server-connection
     *
     * @return bool
     */
    public function isValidPassword ($password) {

	// make sure, infos are loaded
	$this->getInfo('dateOfCreation');

	if (empty($password) and empty($this->password)) return false;

	// check, if no password set
	if ($password == '**********'
	    AND (!isset($this->password)
	    OR empty($this->password))
	) return false;

	return true;
    }

    /* check, if e-mail is valid
     * @param string: boxname of server-connection
     *
     * @return bool
     */
    public function isValidEMail ($email) {
	return $this->_validate($email, 'email');
    }

    /* check, if emailname is valid
     * @param string: emailname of server
     *
     * @return bool
     */
    public function isValidEMailname ($emailname) {
	return $this->_validate($emailname, 'string');
    }

    /* check, if subject is valid
     * @param string: subject of message
     *
     * @return bool
     */
    public function isValidSubject ($subject) {
	return $this->_validate($subject, 'text');
    }

    /* check, if message is valid
     * @param string: message itself
     *
     * @return bool
     */
    public function isValidMessage ($message) {
	return $this->_validate($message, 'html');
    }

    /* check, if addressee is valid
     * @param string: addressee of mail
     *
     * @return bool
     */
    public function isValidAddressee ($addressee) {
	return $this->_validate($addressee, 'email');
    }

    /* save connection-errors
     * @param string: error-message
     *
     * @return string
     */
    public function setError ($error_msg) {

	// save in obj-var
	$this->info['error_msg'] = $error_msg;

	return true;
    }

    /* *********************** server-interaction *************************/
    /* ********************************************************************/

    /* try to get connection-data automatically
     * @param string: host
     * @param int: port
     * @param string: user
     * +@param int/bool: password-authentification
     * +@param int/bool: connection-security
     *
     * @return bool
     */
    protected function validateConnection ($host = false, $port = false, $user = false, $auth = false, $connsecurity = false) {
	global $TSunic;

	// get input
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
	$sql_auth = ($auth === false) ? '' : "auth = '".$auth."' AND ";
	$sql_connsecurity = ($connsecurity === false) ? '' : "connsecurity = '".$connsecurity."' AND ";
	$sql = "SELECT suffix as suffix,
		    host as host,
		    port as port,
		    auth as auth,
		    connsecurity as connsecurity,
		    user as user
		FROM #__knownservers
		WHERE ".$sql_auth.$sql_connsecurity."
		    protocol = '-1'
		    AND (suffix = '".mysql_real_escape_string($suffix)."'
		    OR suffix = '')
		    ".$host_lookup."
		ORDER BY suffix DESC;";
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
	    if ($this->getConnection()) {
		// connected

		// close connection
		$this->closeConnection();

		return true;
	    }

	    // add settings to $checked_versions
	    $checked_versions[] = $this->info;
	}

	// no connection found
	return false;
    }

    /* ************************** send mail *******************************/

    /* send mail
     * @param string: subject of mail
     * @param string: message to send
     * @param array: addressees of mail
     *
     * @return bool
     */
    public function send ($subject, $message, $addressees) {
var_dump('send1');
	if (!$this->isValid()) return false;
	if (!is_array($addressees)) $addressees = array($addressees);
var_dump('send2');

	// validate input
	if (!$this->isValidSubject($subject)
	    OR !$this->isValidMessage($message)
	) {
var_dump($this->isValidSubject($subject));
var_dump($this->isValidMessage($message));
var_dump($subject);
var_dump($message);
	    $this->setError('Invalid input!');
	    return false;
	}
	foreach ($addressees as $index => $value) {
	    if (!$this->isValidAddressee($value)) {
		$this->setError("Invalid addressee '$value'!");
		return false;
	    }
	}
var_dump('send3');

	// initialize connection
	if (!$this->getConnection()) {
	    $this->setError('Connection to SMTP-Server failed!');
	    return false;
	}
var_dump('send4');

	// set sender
	$this->sendData('MAIL FROM: <'.$this->getInfo('email').'>');
	if ($this->getStatus() != 250) {
	    $this->setError('Server rejected MAIL-FROM...');
	    return false;
	}

var_dump('send5');
	// set addressees
	foreach ($addressees as $index => $value) {

	    // add addressee
	    $this->sendData('RCPT TO: <'.$value.'>');
	    if ($this->getStatus() != 250) {
		$this->setError('Server rejected RCPT TO ('.$value.')...');
		return false;
	    }
	}

	// start contenct of mail
	$this->sendData('DATA');
	if ($this->getStatus() != 354) {
	    $this->setError('Server rejected DATA...');
	    return false;
	}

var_dump('send7');
	// get headers
	$headers = '';
	$headers['SUBJECT'] = $subject;
	$headers['FROM'] = $this->getInfo('emailname').' <'.$this->getInfo('email').'>';
	$headers['TO'] = '<'.implode('>, <' ,$addressees).'>';
	$headers['DATE'] = date('r');
	$headers['CONTENT-TYPE'] = 'text/plain; charset:UTF-8';
	$headers['MIME-VERSION'] = '1.0';
	$headers['PRIORITY'] = 'normal';
	$headers['X-MAILER'] = 'PHP/'. phpversion(). ' via TSunic 4.0';

	// sum headers
	$cache = array();
	foreach ($headers as $index => $value) {
	    $cache[] = $index.':'.$value;
	}

	// send headers
	$this->sendData(implode("\r\n", $cache)."\r\n\r\n");

var_dump('send10');
	// get content
	$message = str_replace("\r\n", "\n", $message);
	$message = wordwrap($message, 70);

	// Windows-fix
	if(substr(PHP_OS, 0, 3) == 'WIN') $message = str_replace("\n.", "\n..", $message);

	// send message
	$this->sendData($message."\r\n.\r\n");
	if ($this->getStatus() != 250) {
	    $this->setError('Server rejected header and/or message of mail...');
	    return false;
	}

var_dump('send15');
	// close connection
	$this->closeConnection();

	return true;
    }

    /* *********************** connection-handling ************************/

    /* get connection to server
     *
     * @return bool/stream
     */
    public function getConnection () {

	// check, if valid SMTP server
	if (!$this->isValid()) return false;

	// check, if already connected
	if (!empty($this->conn)) return $this->conn;

	// get host
	$host = $this->getInfo('host');
	if ($this->getConnsecurity(false, true) == 3) {
	    $host = 'tsl://'.$host;
	}

	// try to connect
	$this->conn = @fsockopen($host, $this->getInfo('port'), $errno, $errstr, $this->timeout);
	if (!$this->conn OR $this->getStatus() != 220) {
	    // service not ready
	    $this->conn = NULL;
	    return false;
	}

	// set timeout
	stream_set_timeout($this->conn, $this->timeout);

	// check, if connection exist
	if (!$this->conn) {
	    // error occurred

	    // save error in obj-vars
	    $this->errors['errno'] = $errno;
	    $this->errors['errstr'] = $errstr;

	    $this->conn = NULL;
	    return false;
	}

	// say hello
	$this->sendData('EHLO '.$this->getInfo('host'));
	if ($this->getStatus() != 250) {

	    // try old version
	    $this->sendData('HELO '.$this->getInfo('host'));

	    // check answer
	    if ($this->getStatus() != 250) {
		$this->conn = NULL;
		return false;
	    }
	}

	// initiate TLS
	if ($this->getConnsecurity(false, true) == 2) {

	    // send request
	    @fwrite($this->conn, "STARTTLS\r\n");

	    // check answer
	    if ($this->getStatus() == 220) {
		// success

		// turn on encryption
		$return = @stream_socket_enable_crypto($this->conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

	    } else {
		// fail

		// TODO

		$this->conn = NULL;
		return false;
	    }
	}

	// try to authenticate
	if (!$this->authenticate()) {
	    $this->conn = NULL;
	    return false;
	}

	// return
	return $this->conn;
    }

    /* authenticate to server
     *
     * @return bool
     */
    protected function authenticate () {

	// start authentification
	$this->sendData('AUTH LOGIN');
	if ($this->getStatus() != 334) return false;

	// send user
	$this->sendData(base64_encode($this->getInfo('user')));
	if ($this->getStatus() != 334) return false;

	// send password
	$this->sendData(base64_encode($this->password));
	if ($this->getStatus() != 235) return false;

	return true;
    }

    /* close connection
     *
     * @return bool
     */
    public function closeConnection () {

	// check connection
	if (empty($this->conn)) return true;

	// send QUIT
	fwrite($this->conn, "QUIT\r\n");

	// end stream
	@fclose($this->conn);

	return true;
    }

    /* *********************** general actions ****************************/

    /* send data to server
     *
     * @return bool
     */
    protected function sendData ($data) {

	// check, if connected
	if (!$this->getConnection()) return false;

	// try to send data
	$return = fwrite($this->conn, $data."\r\n", strlen($data)+2);

	// return
	if (!$return) return false;
	return true;
    }

    /* recieve data from server
     *
     * @return bool
     */
    protected function getData () {

	// check, if connected
	if (!$this->getConnection()) return false;

	// get data from server
	$data = '';
	while ($line = fgets($this->conn, 512)) {
	    // add line to data
	    $data.= $line;

	    // check, if end of answer
	    if (substr($line, 3, 1) == ' ') break;
	}

	// return
	return $data;
    }

    /* get status of answer
     *
     * @return bool/int
     */
    protected function getStatus () {

	// get first 3 characters of answer
	return (int) substr($this->getData(), 0, 3);
    }
}
?>
