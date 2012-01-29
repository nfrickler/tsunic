<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			classes/Smtp.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$Smtp {

	/* id of smtp_server
	 * string
	 */
	private $id_mail__smtp;

	/* information about smtp-server
	 * array
	 */
	private $info;

	/* password for smtp-server
	 * string
	 */
	private $password;

	/* mailaccount-object
	 * object
	 */
	private $Mailaccount;

	/* timeout for smtp-connection in seconds
	 * int
	 */
	private $timeout = 5;

	/* password-authentifications
	 * array
	 */
	private $auths = array(1 => array('{CLASS__SMTP__AUTHS_NORMAL}', ''),
						   2 => array('{CLASS__SMTP__AUTHS_ENCRYPTEDPWD}', 'secure'),
						 //  3 => array('{CLASS__SMTP__AUTHS_NTLM}', ''), // not supported
						 //  4 => array('{CLASS__SMTP__AUTHS_KERBEROS_GSSAPI}', ''), // not supported
						   5 => array('{CLASS__SMTP__AUTHS_NOAUTH}', '')
						   );

	/* connections-securities
	 * array
	 */
	private $connsecurities = array(1 => array('{CLASS__SMTP__CONNSECURITIES_NONE}', ''),
								    2 => array('{CLASS__SMTP__CONNSECURITIES_STARTTLS}', ''),
								    3 => array('{CLASS__SMTP__CONNSECURITIES_SSLTLS}', 'tls')
									);

	/* constructor
	 * +@params int $id_mail_server: id_mail_server
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_mail__smtp = 0) {

		// save id
		$this->id_mail__smtp = $id_mail__smtp;

		return;
	}

	/* get all data of smtp-server
	 * +@param bool/string $name: name of data (true will return all data)
	 *
	 * @return array
	 * 		   (OR @return bool: false - error)
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if info already in cache
		if (!empty($this->id_mail__smtp) AND empty($this->info)) {

			// get data from database
			$sql_0 = "SELECT _host_ as host,
							 _user_ as user,
							 _password_ as password,
							 _email_ as email,
							 _emailname_ as emailname,
							 _port_ as port,
							 _description_ as description,
							 auth as auth,
							 connsecurity as connsecurity,
							 fk_mail__account as fk_mail__account,
							 fk_system_users__account as fk_system_users__account,
							 dateOfCreation as dateOfCreation
					  FROM #__smtps
					  WHERE id_mail__smtp = '".mysql_real_escape_string($this->id_mail__smtp)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// return, if no server matched
			if (empty($result_0)) return false;

			// extract password
			$this->password = $result_0[0]['password'];
			$result_0[0]['password'] = 0;
			unset($result_0[0]['password']);

			// store in obj-var
			$this->info = $result_0[0];
		}

		// add default-values
		$this->info['id_mail__smtp'] = $this->id_mail__smtp;
		if (!empty($this->password)) $this->info['password'] = '**********';

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* get mailaccount-object connected to smtp-server
	 * +@param bool $get_id: get id_mail__account instead of object
	 *
	 * @return OBJECT/bool
 	 */
	public function getMailaccount ($get_id = false) {
		global $TSunic;

		// is already in obj-vars?
		if (isset($this->Mailaccount) AND !empty($this->Mailaccount))
			return ($get_id) ? $this->Mailaccount->getInfo('id_mail__account') : $this->Mailaccount;

		// try to get fk_mail__account
		$fk_mail__account = $this->getInfo('fk_mail__account');
		if (empty($fk_mail__account)) return false;

		// try to get object
		$Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);
		if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

		// save in obj-var and return
		$this->Mailaccount = $Mailaccount;
		return ($get_id) ? $this->Mailaccount->getInfo('id_mail__account') : $this->Mailaccount;
	}

	/* set mailaccount
	 * @param object $Mailaccount: mailaccount-object
	 *
	 * @return bool
 	 */
	public function setMailaccount ($Mailaccount) {
		global $TSunic;

		// is valid account?
		if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

		// is new mailaccount?
		if ($Mailaccount->getInfo('id_mail__account') == $this->getInfo('fk_mail__account'))
			return true;

		// save in obj-var
		$this->Mailaccount = $Mailaccount;

		// is smtp-object
		if (!$this->isValid()) {

			// presets
			$this->info['email'] = $Mailaccount->getInfo('email');

			return true;
		}

		// update database
		$sql_0 = "UPDATE #__smtps
					SET fk_mail__account = ".$this->Mailaccount->getInfo('id_mail__account')."
					WHERE id_mail__smtp = ".$this->id_mail__smtp.";";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		return true;
	}

	/* update info-data
	 *
	 * @return true
 	 */
	protected function updateInfo () {

		// reset info
		$this->info = array();

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
	 * +@param string/int/bool $authentification: authentification-number or -name (false will use auth of this object)
	 * +@param bool/string $getNumber: force output to be number (true) or name (false) or phrase ('phrase')
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
	 * +@param string/int/bool $connsecurity: connsecurity-number or -name (false will use consecurity of this object)
	 * +@param bool/string $getNumber: force output to be number (true) or name (false) or phrase ('phrase')
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
	 * @param array $array: converter-array
	 * @param string/int $input: input-number or -name
	 * +@param bool/string $getNumber: force output to be number (true) or name (false) or phrase ('phrase')
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
	 * @param string $email: email-address
	 * @param string $password: password	 
	 * +@param string $description: description
	 * +@param string $emailname: email-name	 	 
	 *
	 * @return bool
 	 */
	public function createSmtp ($email, $password, $description = false, $emailname = false) {
		global $TSunic;

		// validate input
		if (!$this->isValidEMail($email)
				OR !$this->isValidPassword($password)
				OR !$this->isValidDescription($description)
				OR !$this->isValidEMailname($emailname)
		) {
			// invalid input
			return false;	
		}

		// get id_acc
		$id_acc = $TSunic->CurrentUser->getInfo('id_system_users__account');

		// create new server in database
		$sql_0 = "INSERT INTO #__smtps
				  SET _email_ = '".mysql_real_escape_string($email)."',
				  	  _password_ = '".mysql_real_escape_string($password)."',
				  	  _description_ = '".mysql_real_escape_string($description)."',
				  	  _emailname_ = '".mysql_real_escape_string($emailname)."',
				  	  fk_system_users__account = '".mysql_real_escape_string($id_acc)."',
				  	  dateOfCreation = NOW()
				  ;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->id_mail__smtp = mysql_insert_id();
		$this->updateInfo();

		// return
		if ($result_0) return true;
		return false;
	}

	/* set connection for smtp-server
	 * @param string $host: host to connect to smtp-server
	 * @param string $user: user to connect to smtp-server
	 * @param int $port: port to connect to smtp-server
	 * @param int/string $connsecurity: connection-security
	 * @param int/string $auth: password-authentification	 	 
	 *
	 * @return bool
 	 */
	public function setConnection ($host, $port, $user, $connsecurity, $auth) {
		global $TSunic;

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
		$sql_0 = "UPDATE #__smtps
				  SET _host_ = '".mysql_real_escape_string($this->getInfo('host'))."',
					  _user_ = '".mysql_real_escape_string($this->getInfo('user'))."',
					  _port_ = '".mysql_real_escape_string($this->getInfo('port'))."',
					  connsecurity = '".$this->getConnsecurity($this->getInfo('connsecurity'), true)."',
					  auth = '".$this->getAuth($this->getInfo('auth'), true)."'
				  WHERE id_mail__smtp = '".mysql_real_escape_string($this->id_mail__smtp)."';
				  ";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		if ($result_0) return true;
		return false;
	}

	/* edit smtp-server
	 * @param string $email: email-address
	 * @param string $password: password	 
	 * +@param string $description: description
	 * +@param string $emailname: email-name	 
	 *
	 * @return bool
 	 */
	public function editSmtp ($email, $password, $description = true, $emailname = true) {
		global $TSunic;

		// validate input
		if (!$this->isValidEMail($email)
				OR !$this->isValidPassword($password)
				OR !$this->isValidDescription($description)
				OR !$this->isValidEMailname($emailname)
		) {
			// invalid input
			return false;
		}

		// get sql-query-string
		$sql_array = array();
		if ($email !== true) $sql_array[] = "_email_ = '".mysql_real_escape_string($email)."'";
		if ($description !== true) $sql_array[] = "_description_ = '".mysql_real_escape_string($description)."'";
		if ($emailname !== true) $sql_array[] = "_emailname_ = '".mysql_real_escape_string($emailname)."'";

		// check, if password has to be updated
		$sql_password = '';
		if (!empty($password) AND $password != '**********') {
			$sql_array[] = "_password_ = '".mysql_real_escape_string($password)."'";
		}

		// get sql_string
		$sql_string = implode(',', $sql_array);

		// create new server in database
		$sql_0 = "UPDATE #__smtps
				  SET ".$sql_string."
				  WHERE id_mail__smtp = '".mysql_real_escape_string($this->id_mail__smtp)."'
				  ;";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		if (!$result_0) return false;
		return true;
	}

	/* delete smtp-server
	 *
	 * @return bool
 	 */
	public function deleteSmtp () {
		global $TSunic;

		// delete smtp-server in database
		$sql_0 = "DELETE FROM #__smtps
				  WHERE id_mail__smtp = '".mysql_real_escape_string($this->id_mail__smtp)."';";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* check, if fk_mail__account is valid
	 * @param string $host: host of server-connection
	 *
	 * @return bool
 	 */
	public function isValidFkmailaccount ($fk_mail__account) {

		// is_numeric?
		if (!empty($fk_mail__account) AND !is_numeric($fk_mail__account)) return false;

		return true;
	}

	/* check, if host is valid
	 * @param string $host: host of server-connection
	 *
	 * @return bool
 	 */
	public function isValidHost ($host) {

		// check, if string is empty
		if (empty($host)) return false;

		return true;
	}

	/* check, if description is valid
	 * @param string $description: description
	 *
	 * @return bool
 	 */
	public function isValidDescription ($description) {

		return true;
	}

	/* check, if port is valid
	 * @param string $port: port of server-connection
	 *
	 * @return bool
 	 */
	public function isValidPort ($port) {

		// check, if string is empty
		if (!empty($port) AND !is_numeric($port)) return false;

		return true;
	}

	/* check, if auth is valid
	 * @param int $auth: security
	 *
	 * @return bool
 	 */
	public function isValidAuth ($auth) {

		// check, if auth-value allowed
		if (isset($this->auths[$auth])) {
			return true;
		}

		return false;
	}

	/* check, if connsecurity is valid
	 * @param int $connsecurity: connsecurity
	 *
	 * @return bool
 	 */
	public function isValidConnsecurity ($connsecurity) {

		// check, if connsecurity-value allowed
		if (isset($this->connsecurities[$connsecurity])) {
			return true;
		}

		return false;
	}

	/* get possible auths ($auth = true) OR name of one auth ($auth = int) OR authname of this object ($auth = false)
	 * +@param int/bool $auth: security
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
	 * @param string $user: user of server-connection
	 *
	 * @return bool
 	 */
	public function isValidUser ($user) {

		// check, if string is empty
		if (empty($user)) return false;

		return true;
	}

	/* check, if password is valid
	 * @param string $password: password of server-connection
	 *
	 * @return bool
 	 */
	public function isValidPassword ($password) {

		// load infos
		$this->getInfo('dateOfCreation');

		// check, if string is empty
		if (empty($password)) return false;

		// check, if no password set
		if ($password == '**********'
				AND (!isset($this->password)
				OR empty($this->password)))
			return false;

		return true;
	}

	/* check, if e-mail is valid
	 * @param string $boxname: boxname of server-connection
	 *
	 * @return bool
 	 */
	public function isValidEMail ($email) {

		// check, if string is empty
		if (empty($email)) return false;

		return true;
	}

	/* check, if emailname is valid
	 * @param string $emailname: emailname of server
	 *
	 * @return bool
 	 */
	public function isValidEMailname ($emailname) {

		return true;
	}

	/* check, if subject is valid
	 * @param string $emailname: subject of message
	 *
	 * @return bool
 	 */
	public function isValidSubject ($subject) {

		// check, if string is empty
		if (empty($subject)) return false;

		return true;
	}

	/* check, if message is valid
	 * @param string $message: message itself
	 *
	 * @return bool
 	 */
	public function isValidMessage ($message) {

		// check, if string is empty
		if (empty($message)) return false;

		return true;
	}

	/* check, if addressee is valid
	 * @param string $addressee: addressee of mail
	 *
	 * @return bool
 	 */
	public function isValidAddressee ($addressee) {

		// validate e-mail-address
		if (preg_match('#[a-zA-Z0-9_.-öäüÄÖÜ]+@[a-zA-Z0-9_-öäüÄÖÜ]+\.[a-zA-Z]+#', $addressee) == 0) {
			return false;
		}

		return true;
	}

	/* check, if valid smtp-object
	 *
	 * @return bool
 	 */
	public function isValid () {

		// check, if id exists
		if (!isset($this->id_mail__smtp) OR empty($this->id_mail__smtp))
			return false;

		// check, if smtp-server in database
		$dateOfCreation = $this->getInfo('dateOfCreation');
		if (empty($dateOfCreation)) return false;

		return true;
	}

	/* save connection-errors
	 * @param string $error_msg: error-message
	 *
	 * @return string
 	 */
	public function setError ($error_msg) {

		// save in obj-var
		$this->info['error_msg'] = $error_msg;

		return true;
	}

	/* *********************** server-interaction *****************************/
	/* ************************************************************************/

	/* try to get connection-data automatically
	 * @param string $host: host
	 * @param int $port: port
	 * @param string $user: user
	 * +@param int/bool $auth: password-authentification
	 * +@param int/bool $connsecurity: connection-security	 	 	 	 
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
		$sql_0 = "SELECT suffix as suffix,
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

	/* ************************** send mail ***********************************/

	/* send-mail
	 * @param string $addressees: addressees of mail
	 * @param string $subject: subject of mail
	 * @param string $message: message to send	 	 
	 *
	 * @return bool
 	 */
	public function sendMail ($addressees, $subject, $message) {

		// validate input
		if (!$this->isValidSubject($subject)
				OR !$this->isValidMessage($message)
				OR empty($this->id_mail__smtp)
		) {
			$this->setError('Invalid input!');
			return false;
		}
		foreach ($addressees as $index => $value) {
			if (!$this->isValidAddressee($value)) {
				$this->setError('Invalid addressee!');
				return false;
			}
		}

		// initialize connection
		if (!$this->getConnection()) {
			// connection failed
			$this->setError('Connection to SMTP-Server failed!');
			return false;
		}

		// set sender
		$this->sendData('MAIL FROM: <'.$this->getInfo('email').'>');
		if ($this->getStatus() != 250) {
			// error
			$this->setError('Server rejected MAIL-FROM...');
			return false;
		}

		// set addressees
		foreach ($addressees as $index => $value) {

			// add addressee
			$this->sendData('RCPT TO: <'.$value.'>');
			if ($this->getStatus() != 250) {
				// error
				$this->setError('Server rejected RCPT TO ('.$value.')...');
				return false;
			}
		}

		// start contenct of mail
		$this->sendData('DATA');
		if ($this->getStatus() != 354) {
			// error
			$this->setError('Server rejected DATA...');
			return false;
		}

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

		// get content
		$message = str_replace("\r\n", "\n", $message);
		$message = wordwrap($message, 70);

    	// Windows-fix
		if(substr(PHP_OS, 0, 3) == 'WIN') $message = str_replace("\n.", "\n..", $message);

		// send message
		$this->sendData($message."\r\n.\r\n");
		if ($this->getStatus() != 250) {
			// error
			$this->setError('Server rejected header and/or message of mail...');
			return false;
		}

		// close connection
		$this->closeConnection();

		return true;
	}

	/* *********************** connection-handling ****************************/

	/* send-mail
	 *
	 * @return bool/stream
 	 */
	public function getConnection () {

		// check, if already connected
		if (!empty($this->conn)) return $this->conn;

		// check, if valid smtp-server
		if (empty($this->id_mail__smtp)) return false;

		// get host
		$host = $this->getInfo('host');
		if ($this->getConnsecurity(false, true) == 3) {
			$host = 'tsl://'.$host;
		}

		// try to connect
		$this->conn = @fsockopen($host, $this->getInfo('port'), $errno, $errstr, $this->timeout);
		if (!$this->conn OR $this->getStatus() != 220) {
			// service not ready
			return false;
		}

		// set timeout
		stream_set_timeout($this->conn, $this->timeout);

		// check, if connection exist
		if (!$this->conn) {
			// error occurred
			$this->conn = false;

			// save error in obj-vars
			$this->errors['errno'] = $errno;
			$this->errors['errstr'] = $errstr;

			return false;
		}

		// say hello
		$this->sendData('EHLO '.$this->getInfo('host'));
		if ($this->getStatus() != 250) {

			// try old version
			$this->sendData('HELO '.$this->getInfo('host'));

			// check answer
			if ($this->getStatus() != 250) return false;
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

				return false;
			}
		}

		// try to authenticate
		if (!$this->authenticate()) return false;

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

	/* *********************** general actions ********************************/

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