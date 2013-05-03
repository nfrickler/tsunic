<!-- | CLASS Encryption_mcrypt -->
<?php
/** Encryption class using mcrypt
 *
 * This is a TSunic wrapper for mcrypt
 */
class $$$Encryption_mcrypt {

    /** Encryption key
     * @var string $key
     */
    private $key;

    /** Algorithm (e.g. blowfish)
     * @var string $algorithm
     */
    private $algorithm;

    /** Mode (e.g. ecb)
     * @var string $mode
     */
    private $mode;

    /** Cypher object
     * @var object $cipher_obj
     */
    private $cipher_obj;

    /** Constructor
     * @param string $algorithm
     *	Algorithm
     * @param string $mode
     *	Encryption mode
     */
    public function __construct ($algorithm, $mode) {

	// save
	$this->algorithm = $algorithm;
	$this->mode = $mode;

	// get cypher-object
	$this->cypher_obj = mcrypt_module_open($this->algorithm, '', $this->mode, '');

	return;
    }

    /** Set key for en-/decryption
     * @param string $key
     *	Encryption key
     *
     * @return bool
     */
    public function setKey ($key) {
	$this->key = $key;
	return true;
    }

    /** Encrypt string
     * @param string $input
     *	String to be encrypted
     * @param string $key
     *	Encryption key
     *
     * @return string
     */
    public function encrypt ($input, $key = false) {
	if (empty($key)) $key = $this->key;

	// init
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($this->cypher_obj), MCRYPT_RAND);
	mcrypt_generic_init($this->cypher_obj, $key, $iv);

	// encrypt
	$output = mcrypt_generic($this->cypher_obj, $input);

	// deinit
	mcrypt_generic_deinit($this->cypher_obj);
	return $output;
    //    return base64_encode($output);
    }

    /** Decrypt string
     * @param string $input
     *	String to be decrypted
     * @param string $key
     *	Decryption key
     *
     * @return string
     */
    public function decrypt ($input, $key = false) {
	if (empty($input)) return '';
    //    $input = base64_decode($input);

	// init
	if (empty($key)) $key = $this->key;
	$ivsize = mcrypt_get_iv_size($this->algorithm, $this->mode);
	$iv = substr($input, 0, $ivsize);
    //    $input = substr($input, 0, $ivsize);
	mcrypt_generic_init ($this->cypher_obj, $key, $iv);

	// decrypt
	$output = mdecrypt_generic($this->cypher_obj, $input);

	// deinit
	mcrypt_generic_deinit ($this->cypher_obj);
	return trim($output);
    }
}
?>
