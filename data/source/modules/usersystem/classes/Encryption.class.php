<!-- | Class to handle encryption -->
<?php
class $$$Encryption {

	/* encryptionClass-object
	 * object
	 */
	private $MyEnc;

	/* encryption-preffix
	 * string
	 */
	private $enc_preffix = '#enc_preffix#';

	/* ready for encryption?
	 * bool
	 */
	private $ready = false;

	/* constructor
	 * @param string: passphrase
	 */
	public function __construct ($passphrase) {
		global $TSunic;

		// try to load encryption-object of chosen encryption
		$this->MyEnc = $TSunic->get('$$$Encryption_'.$TSunic->Config->getConfig('encryption_class'));
		if (!$this->MyEnc) {
			// object could not be created
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// load password
		$this->_getKey($passphrase);

		return;
	}

	/* load en-/decryption-password of current user
	 * @param string: passphrase
	 *
	 * @return bool
	 */
	private function _getKey ($passphrase) {
		global $TSunic;
		$this->ready = false;

		// get system secret
		$system_secret = $TSunic->Config->getConfig('system_secret');

		// encrypt passphrase with system_secret to get userkey
		$userkey = $this->MyEnc->encrypt($passphrase, $system_secret);
		$this->MyEnc->setKey($userkey);

		$this->ready = true;
		return true;
	}

	/* encrypt string
	 * @param string: input
	 * +@param string: encryption key
	 *
	 * @return string
	 */
	public function encrypt ($input, $key = false) {
		global $TSunic;

		// skip empty input
		if (empty($input)) return $input;

		// is ready for encryption?
		if (!$this->ready) {
			$TSunic->Log->add('error', 'Encryption called, but not ready yet!', 1);
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// encrypt
		return $this->enc_preffix.$this->MyEnc->encrypt($input, $key);
	}

	/* decrypt string
	 * @param string: input
	 * +@param string: encryption key
	 *
	 * @return string
	 */
	public function decrypt ($input, $key = false) {

		// check, if value is encrypted
		if (substr($input, 0, strlen($this->enc_preffix)) != $this->enc_preffix) {
			// input not encrypted
			return $input;
		}

		// remove preffix
		$input = substr($input, (strlen($this->enc_preffix)));
		if (empty($input)) return $input;

		// is ready for decryption?
		if (!$this->ready) {
			$TSunic->Log->add('error', 'Encryption called, but not ready yet!', 1);
			$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
		}

		// decrypt
		return $this->MyEnc->decrypt($input, $key);
	}
}
?>
