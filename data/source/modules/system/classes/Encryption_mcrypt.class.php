<!-- | class for mcrypt encryption -->
<?php

class $$$Encryption_mcrypt {

	/* key for encryption
	 * string
	 */
	private $key;

	/* algorithm (e.g. blowfish)
	 * string
	 */
	private $algorithm;

	/* mode (e.g. ecb)
	 * string
	 */
	private $mode;

	/* cypher-object
	 * object
	 */
	private $cipher_obj;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {
		global $TSunic;

		// load algorithm and mode
		$this->algorithm = $TSunic->Config->getConfig('encryption_algorithm');
		$this->mode = $TSunic->Config->getConfig('encryption_mode');

		// get cypher-object
		$this->cypher_obj = mcrypt_module_open($this->algorithm, '', $this->mode, '');

		return;
	}

	/* set password for en-/decryption
	 * @param string $key: encryption-key
	 *
	 * @return bool
	 */
	public function setPassword ($key) {

		// save key in obj-vars
		$this->key = $key;

		return true;
	}

	/* encrypts string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function encrypt ($input) {

		// init
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->cypher_obj), MCRYPT_RAND); 
		mcrypt_generic_init($this->cypher_obj, $this->key, $iv);

		// encrypt
		$output = mcrypt_generic($this->cypher_obj, $input);

		// deinit
		mcrypt_generic_deinit($this->cypher_obj);
		return $output;
	//	return base64_encode($output);
	}

	/* decrypts string
	 * @param string $input: input-string
	 *
	 * @return string
 	 */
	public function decrypt ($input) {
		if (empty($input)) return '';
	//	$input = base64_decode($input);

		// init
		$ivsize = mcrypt_get_iv_size($this->algorithm, $this->mode);
		$iv = substr($input, 0, $ivsize);
	//	$input = substr($input, 0, $ivsize);
		mcrypt_generic_init ($this->cypher_obj, $this->key, $iv);

		// decrypt
		$output = mdecrypt_generic($this->cypher_obj, $input);

		// deinit
		mcrypt_generic_deinit ($this->cypher_obj);
		return trim($output);
	}
}
?>
