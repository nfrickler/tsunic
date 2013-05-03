<!-- | CLASS Smtp -->
<?php
/** Smtp class
 *
 * Handling connection to SMTP server
 */
class $$$Smtp extends $system$Object {

    /** Tablename in database
     * @var string $table
     */
    protected $table = "#__$mail$smtps";

    /** Password for SMTP server
     * @var string $password
     */
    private $password;

    /** Timeout for SMTP connection in seconds
     * @var int $timeout
     */
    protected $timeout = 5;

    /** Password authentifications
     * @var array $auths
     */
    protected $auths = array(
	1 => array('{CLASS__SMTP__AUTHS_NORMAL}', ''),
	2 => array('{CLASS__SMTP__AUTHS_ENCRYPTEDPWD}', 'secure'),
	//  3 => array('{CLASS__SMTP__AUTHS_NTLM}', ''), // not supported
	//  4 => array('{CLASS__SMTP__AUTHS_KERBEROS_GSSAPI}', ''), // not supported
	5 => array('{CLASS__SMTP__AUTHS_NOAUTH}', '')
    );

    /** Connections securities
     * @var array $connsecurities
     */
    protected $connsecurities = array(
	1 => array('{CLASS__SMTP__CONNSECURITIES_NONE}', ''),
	2 => array('{CLASS__SMTP__CONNSECURITIES_STARTTLS}', ''),
	3 => array('{CLASS__SMTP__CONNSECURITIES_SSLTLS}', 'tls')
    );

    /** Get name of this object
     *
     * @return string
     */
    public function getName () {
	$name = $this->getInfo('emailname');
	if ($this->getInfo('email')) $name .= "<".$this->getInfo('email').">";
	return $name;
    }

    /** Get all available connectio security options
     *
     * @return array
     */
    public function getAllConnsecurities () {
	return $this->connsecurities;
    }

    /** Get all available password authentication options
     *
     * @return array
     */
    public function getAllAuths () {
	return $this->auths;
    }

    /** Get number or name of password authentification
     * @param string|int|bool $auth
     *	Authentification-number or -name (false will use auth of this object)
     * @param bool|string $getNumber
     *	Force output to be number (true) or name (false) or phrase ('phrase')
     *
     * @return int/string
     */
    public function getAuth ($auth = false, $getNumber = false) {

	// get auth
	if ($auth == false) $auth = $this->getInfo('auth');

	// convert and return
	return $this->convertNumberName($this->auths, $auth, $getNumber);
    }

    /** Get number or name of connection-security
     * @param string|int|bool $connsecurity
     *	Connsecurity-number or -name (false will use consecurity of this object)
     * @param bool|string $getNumber
     *	Force output to be number (true) or name (false) or phrase ('phrase')
     *
     * @return int/string
     */
    public function getConnsecurity ($connsecurity = false, $getNumber = false) {

	// get connsecurity
	if ($connsecurity == false) $connsecurity = $this->getInfo('connsecurity');

	// convert and return
	return $this->convertNumberName($this->connsecurities, $connsecurity, $getNumber);
    }

    /** Convert from number to name or vice versa
     * @param array $array
     *	Converter array
     * @param string|int $input
     *	Input number or -name
     * @param bool|string $getNumber
     *	Force output to be number (true) or name (false) or phrase ('phrase')
     *
     * @return int|string
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

    /** Create new Smtp object
     * @param string $email
     *	E-mail address
     * @param string $password
     *	Password
     * @param string $description
     *	Description
     * @param string $emailname
     *	Email name
     *
     * @return bool
     */
    public function create ($email, $password, $description = false, $emailname = false) {

	// create new server in database
	global $TSunic;
	$data = array(
	    "email" => $email,
	    "password" => $password,
	    "description" => $description,
	    "emailname" => $emailname,
	    "dateOfCreation" => "NOW()",
	    "fk_account" => $TSunic->Usr->getInfo('id')
	);
	return $this->_create($data);
    }

    /** Set connection for SMTP server
     * @param string $host
     *	Host to connect to smtp server
     * @param string $user
     *	User to connect to smtp server
     * @param int $port
     *	Port to connect to smtp server
     * @param int|string $connsecurity
     *	Connection security
     * @param int|string $auth
     *	Password authentification
     *
     * @return bool
     */
    public function setAutoConnection (
	$host = false, $port = false, $user = false,
	$connsecurity = false, $auth = false
    ) {

	// detect connection
	if (!$this->detectConnection(
	    $host, $port, $user, $connsecurity, $auth
	)) {
	    return false;
	}

	// save detected connection
	if ($this->setConnection(
	    $this->getInfo('host'),
	    $this->getInfo('port'),
	    $this->getInfo('user'),
	    $this->getInfo('connsecurity'),
	    $this->getInfo('auth')
	)) return true;

	return false;
    }

    /** Set connection for SMTP server
     * @param string $host
     *	Host to connect to smtp server
     * @param string $user
     *	User to connect to smtp server
     * @param int $port
     *	Port to connect to smtp server
     * @param int|string $connsecurity
     *	Connection security
     * @param int|string $auth
     *	Password authentification
     *
     * @return bool
     */
    public function setConnection (
	$host, $port, $user, $connsecurity, $auth
    ) {
	global $TSunic;

	// update database
	$data = array(
	    "host" => $this->getInfo('host'),
	    "user" => $this->getInfo('user'),
	    "port" => $this->getInfo('port'),
	    "connsecurity" => $this->getConnsecurity($this->getInfo('connsecurity'), true),
	    "auth" => $this->getAuth($this->getInfo('auth'), true)
	);
	return $this->setMulti($data, true);
    }

    /** Checks whether a value of this object is valid
     * @param string $name
     *	Name of value
     * @param string $value
     *	Value
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
		if (!$this->_validate($value, 'int')) return false;
		break;
	    case 'connsecurity':
		if (!$this->_validate($value, 'int')) return false;
		break;
	    case 'email':
		if (!$this->isValidEMail($value)) return false;
		break;
	    case 'password':
		if (!$this->isValidPassword($value)) return false;
		break;
	    case 'description':
		if (!$this->isValidDescription($value)) return false;
		break;
	    case 'emailname':
		if (!$this->isValidEMailname($value)) return false;
		break;
	}

	return parent::isValidInfo($name, $value);
    }

    /** Edit Smtp object
     * @param string $email
     *	E-mail-address
     * @param string $password
     *	Password
     * @param string $description
     *	Description
     * @param string $emailname
     *	E-mail-name
     *
     * @return bool
     */
    public function edit ($email, $password, $description = '', $emailname = '') {
	$data = array(
	    "email" => $email,
	    "password" => $password,
	    "description" => $description,
	    "emailname" => $emailname
	);
	return $this->setMulti($data);
    }

    /** Delete Smtp object
     *
     * @return bool
     */
    public function deleteSmtp () {
	return $this->_delete();
    }

    /** Check, if host is valid
     * @param string $host
     *	Host of server connection
     *
     * @return bool
     */
    public function isValidHost ($host) {
	return $this->_validate($host, 'url');
    }

    /** Check, if description is valid
     * @param string $description
     *	Description
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description) or $this->_validate($description, 'string'));
    }

    /** Check, if port is valid
     * @param string $port
     *	Port of server connection
     *
     * @return bool
     */
    public function isValidPort ($port) {
	return (empty($port) or $this->_validate($port, 'int'));
    }

    /** Check, if auth is valid
     * @param int $auth
     *	Password security
     *
     * @return bool
     */
    public function isValidAuth ($auth) {
	return isset($this->auths[$auth]);
    }

    /** Check, if connsecurity is valid
     * @param int $connsecurity
     *	Connsecurity
     *
     * @return bool
     */
    public function isValidConnsecurity ($connsecurity) {
	return (isset($this->connsecurities[$connsecurity])) ? true : false;
    }

    /** Get possible auths ($auth = true) OR
     * name of one auth ($auth = int) OR
     * authname of this object ($auth = false)
     * @param int|bool $auth
     *	Password security
     *
     * @return int|array
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

    /** Check, if user is valid
     * @param string $user
     *	User of server connection
     *
     * @return bool
     */
    public function isValidUser ($user) {
	return $this->_validate($user, 'extString');
    }

    /** Check, if password is valid
     * @param string $password
     *	Password of server connection
     *
     * @return bool
     */
    public function isValidPassword ($password) {
	$old_pass = $this->getInfo('password');

	// no password set?
	if ((empty($password) or $password == '**********') and
	    empty($old_pass)
	) return false;

	return true;
    }

    /** Check, if e-mail is valid
     * @param string $email
     *	E-mail address
     *
     * @return bool
     */
    public function isValidEMail ($email) {
	return $this->_validate($email, 'email');
    }

    /** Check, if emailname is valid
     * @param string $emailname
     *	E-mailname of server
     *
     * @return bool
     */
    public function isValidEMailname ($emailname) {
	return $this->_validate($emailname, 'string');
    }

    /** Save connection-errors
     * @param string $error_msg
     *	Error message
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

    /** Try to get or validate connection data automatically
     * @param string $host
     *	Host
     * @param int $port
     *	Port
     * @param string $user
     *	User
     * @param int|bool $auth
     *	Password authentification
     * @param int|bool $connsecurity
     *	Connection security
     *
     * @return bool
     */
    protected function detectConnection (
	$host = false, $port = false, $user = false, $auth = false,
	$connsecurity = false
    ) {
	global $TSunic;

	// get input
	$auth = (empty($auth)) ? false : $this->getAuth($auth, true);
	$connsecurity = (empty($connsecurity))
	    ? false : $this->getConnsecurity($connsecurity, true);

	// get assumed host-postfix and user
	$email = $this->getInfo('email');
	$cache = explode('@', $email);
	if (count($cache) < 2) return false;
	$emailuser = trim($cache[0]);
	$suffix = trim($cache[1]);
	$host_lookup = (!empty($host))
	    ? "OR host = '".mysql_real_escape_string($host)."'" : '';

	// get matching entries from connection table
	$sql_auth = ($auth === false) ? '' : "auth = '".$auth."' AND ";
	$sql_connsecurity = ($connsecurity === false)
	    ? '' : "connsecurity = '".$connsecurity."' AND ";
	$sql = "SELECT suffix as suffix,
		    host as host,
		    port as port,
		    auth as auth,
		    connsecurity as connsecurity,
		    user as user
		FROM #__$mail$knownservers
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
	    $TSunic->Log->log(6,
		"Smtp: Validate connection ".$values['host']." : ".
		$values['port']." ..."
	    );

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
	    $con_data['connsecurity'] = (empty($connsecurity))
		? $values['connsecurity'] : $connsecurity;
	    $con_data['user'] = ($values['user'] == 2)
		? $email : $emailuser;
	    if (!empty($user)) $con_data['user'] = $user;

	    // already checked these settings?
	    foreach ($checked_versions as $in => $val) {
		if ($val == $con_data) {
		    continue 2;
		}
	    }

	    // set connection data temporarily
	    if (!$this->setMulti($con_data, false)) {
		$TSunic->Log->log(6,
		    "Smtp::detectConnection: Failed to set data!"
		);
	    }

	    // try to connect...
	    if ($this->getConnection()) {
		// connected

		// close connection
		$this->closeConnection();

		return true;
	    }

	    // add settings to $checked_versions
	    $checked_versions[] = $con_data;
	}

	// no connection found
	return false;
    }

    /* ************************** send mail *******************************/

    /** Send Mail
     * @param Mail $Mail
     *	Mail object to be send
     * @param string $addressee
     *	E-mail of addressee
     *
     * @return bool
     */
    public function send ($Mail, $addressee) {
	if (!$this->isValid()) return false;
	if (!$Mail->isValid()) return false;
	if (!$this->isValidEMail($addressee)) return false;
	global $TSunic;

	// initialize connection
	if (!$this->getConnection()) {
	    $this->setError('Connection to SMTP server failed!');
	    return false;
	}

	// set sender
	$this->sendData('MAIL FROM: <'.$this->getInfo('email').'>');
	if ($this->getStatus() != 250) {
	    $this->setError('Server rejected MAIL-FROM...');
	    return false;
	}

	$this->sendData('RCPT TO: <'.$addressee.'>');
	if ($this->getStatus() != 250) {
	    $this->setError('Server rejected RCPT TO ('.$addressee.')...');
	    return false;
	}

	// start contenct of mail
	$this->sendData('DATA');
	if ($this->getStatus() != 354) {
	    $this->setError('Server rejected DATA...');
	    return false;
	}

	// get headers
	$headers = '';
	$headers['SUBJECT'] = $Mail->getInfo('subject');
	$headers['FROM'] = $this->getInfo('emailname').
	    ' <'.$this->getInfo('email').'>';
	$headers['TO'] = '<'.$addressee.'>';
	$headers['DATE'] = date('r');
	$headers['CONTENT-TYPE'] = 'text/plain; charset:UTF-8';
	$headers['MIME-VERSION'] = '1.0';
	$headers['PRIORITY'] = 'normal';
	$headers['X-MAILER'] = 'PHP/'. phpversion(). ' via TSunic '.
	    $TSunic->Config->get('version');

	// sum headers
	$cache = array();
	foreach ($headers as $index => $value) {
	    $cache[] = $index.':'.$value;
	}

	// send headers
	$this->sendData(implode("\r\n", $cache)."\r\n\r\n");

	// get content
	$message = $Mail->getContent();
	$message = str_replace("\r\n", "\n", $message);
	$message = wordwrap($message, 70);

	// Windows-fix
	if(substr(PHP_OS, 0, 3) == 'WIN')
	    $message = str_replace("\n.", "\n..", $message);

	// send message
	$this->sendData($message."\r\n.\r\n");
	if ($this->getStatus() != 250) {
	    $this->setError('Server rejected header and/or message of mail...');
	    return false;
	}

	// close connection
	$this->closeConnection();

	return true;
    }

    /* *********************** connection handling ************************/

    /** Get connection to server
     *
     * @return bool|stream
     */
    public function getConnection () {
	global $TSunic;

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
	$TSunic->Log->log(6,
	    "Smtp: Connect to ".$host." : ".$this->getInfo('port')
	);
	$this->conn = fsockopen(
	    $host, $this->getInfo('port'), $errno, $errstr, $this->timeout
	);
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
		$return = @stream_socket_enable_crypto(
		    $this->conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT
		);

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

	// success
	$TSunic->Log->log(6,
	    "Smtp: Successfully connected to ".$host." : ".
	    $this->getInfo('port')
	);
	return $this->conn;
    }

    /** Authenticate to server
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

    /** Close connection
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

    /** Send data to server
     * @param string $data
     *	Data to be send
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

    /** Recieve data from server
     *
     * @return string
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

	return $data;
    }

    /** Get status of answer
     *
     * @return bool|int
     */
    protected function getStatus () {
	// get first 3 characters of answer
	return (int) substr($this->getData(), 0, 3);
    }
}
?>
