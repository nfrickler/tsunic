<!-- | class to handle encryption -->
<?php

class $$$Encryption {

	/* encryptionClass-object
	 * object
	 */
	private $enc_obj;

	/* encryption-preffix
	 * string
	 */
	private $enc_preffix = '#enc_preffix#';

	/* encryption-preffix
	 * string
	 */
	private $session_key = '$$$Encryption_usrpwd';

	/* is everything ready for encryption (password loaded)?
	 * bool
	 */
	private $enc_ready = false;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		global $TSunic;

		// try to load encryption-object of chosen encryption
		$this->enc_obj = $TSunic->get('$$$Encryption_'.$TSunic->Config->getConfig('encryption_class'));
		if (!$this->enc_obj) {
			// object could not be created
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// load password
		$this->_loadPassword();

		return;
	}

	/* load en-/decryption-password of current user
	 *
	 * @return string
 	 */
	private function _loadPassword () {
		global $TSunic;
		$this->enc_ready = false;

		// check, if password in SESSION
		if (isset($_SESSION[$this->session_key])
				AND !empty($_SESSION[$this->session_key])
		) {
			$current_key = $_SESSION[$this->session_key];
		} else {
			$current_key = $TSunic->Config->getConfig('system_secret');
		}

		// encrypt usr_password with system_secret
		$this->enc_obj->setPassword($TSunic->Config->getConfig('system_secret'));
		$current_key = $this->enc_obj->encrypt($current_key);

		// save current_key as new encryption-key
		$this->enc_obj->setPassword($current_key);

		$this->enc_ready = true;
		return true;
	}

	/* set en-/decryption-password of current user (at login)
	 * @param string $usr_password: password of user
	 *
	 * @return bool
 	 */
	public function setPassword ($usr_password) {

		// save usr_password in SESSION
		$_SESSION[$this->session_key] = md5($usr_password);

		// reload password
		$this->_loadPassword();

		return true;
	}

	/* encrypt string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function encrypt ($input) {
		global $TSunic;

		// skip empty input
		if (empty($input)) return $input;

		// is ready for encryption?
		if (!$this->enc_ready) {
			$TSunic->Log->add('error', 'Encryption called, but not ready yet!', 1);
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// encrypt
		$output = $this->enc_preffix.$this->enc_obj->encrypt($input);

		return $output;
	}

	/* decrypt string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function decrypt ($input) {

		// check, if value is encrypted
		if (substr($input, 0, strlen($this->enc_preffix)) != $this->enc_preffix) {
			// input not encrypted
			return $input;
		}

		// skip preffix
		$input = substr($input, (strlen($this->enc_preffix)));

		// skip empty input
		if (empty($input)) return $input;

		// is ready for encryption?
		if (!$this->enc_ready) {
			$TSunic->Log->add('error', 'Encryption called, but not ready yet!', 1);
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// decrypt
		$output = $this->enc_obj->decrypt($input);

		return $output;
	}
}
?>
