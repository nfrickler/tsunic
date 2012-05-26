<!-- | Local e-mail sender class -->
<?php
include_once '$$$Smtp.class.php';
class $$$SenderLocal extends $$$Smtp {

	/* get all data of smtp-server
	 * +@param bool/string: name of data (true will return all data)
	 *
	 * @return array/false
	 */
	public function getInfo ($name = true) {
		global $TSunic;

		if (empty($this->info)) {

			// set data
			$this->info['host'] = '{CLASS__SENDERLOCAL__HOST}';
			$this->info['port'] = '0';
			$this->info['user'] = '{CLASS__SENDERLOCAL__USER}';
			$this->info['email'] = $TSunic->Config->getConfig('system_email');
			$this->info['emailname'] = $TSunic->CurrentUser->getInfo('name');
			$this->info['host'] = 0;
			$this->info['id'] = 0;
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* create new smtp-server
	 * @param string: host
	 * @param int: port
	 * @param string: user
	 * @param string: password
	 * @param string: email-address
	 * @param string: email-name
	 *
	 * @return bool
	 */
	public function create ($host, $port, $user, $password, $email, $emailname) {
		return false;
	}

	/* edit smtp-server
	 * @param string: host
	 * @param int: port
	 * @param string: user
	 * @param string: password
	 * @param string: email-address
	 * @param string: email-name
	 *
	 * @return bool
	 */
	public function edit ($host, $port, $user, $password, $email, $emailname) {
		return false;
	}

	/* delete smtp-server
	 *
	 * @return bool
	 */
	public function delete () {
		return false;
	}

	/* check, if host is valid
	 * @param string: host of server-connection
	 *
	 * @return bool
	 */
	public function isValidHost ($host) {
		return false;
	}

	/* check, if port is valid
	 * @param string: port of server-connection
	 *
	 * @return bool
	 */
	public function isValidPort ($port) {
		return false;
	}

	/* check, if user is valid
	 * @param string: user of server-connection
	 *
	 * @return bool
	 */
	public function isValidUser ($user) {
		return false;
	}

	/* check, if password is valid
	 * @param string: password of server-connection
	 *
	 * @return bool
	 */
	public function isValidPassword ($password) {
		return false;
	}

	/* check, if smtp-server exists
	 *
	 * @return bool
	 */
	public function isValid () {
		return true;
	}

	/* send mail with php mail()-function
	 * @param array: array with addressees
	 * @param string: subject of message
	 * @param string: the message itself
	 *
	 * @return bool
	 */
	public function sendMail ($addressees, $subject, $message) {
		global $TSunic;

		// is system-email activated?
		if (!$TSunic->Config->getConfig('email_enabled')) {
			return false;
		}

		// validate input
		if (!$this->isValidSubject($subject)
				OR !$this->isValidMessage($message)
		) {
			return false;
		}
		foreach ($addressees as $index => $value) {
			if (!$this->isValidAddressee($value)) return false;
		}

		// validate sender
		$sender = $this->getInfo('email');
		if (empty($sender)) return false;

		// get header of mail
		$headers = '';
		$headers.= 'From:'.$this->getInfo('emailname').'<'.$this->getInfo('email').'>';

		// send mails
		$this->info['error_msg'] = '';
		foreach ($addressees as $index => $value) {

			// send mail
			$return = mail($value, $subject, $message, $headers);

			if ($return == false) {
				// mail could not be sent
				$this->info['error_msg'].= 'Mail to '.$value.' could not be sent! ';
			}
		}

		// return
		if (empty($this->info['error_msg'])) return true;
		return false;
	}
}
?>
