<!-- | Class for mcrypt encryption -->
<?php
class $$$Encryption_mcrypt {

    /* encryption key
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
     * @param string: algorithm
     * @param string: encryption mode
     */
    public function __construct ($algorithm, $mode) {

	// save
	$this->algorithm = $algorithm;
	$this->mode = $mode;

	// get cypher-object
	$this->cypher_obj = mcrypt_module_open($this->algorithm, '', $this->mode, '');

	return;
    }

    /* set key for en-/decryption
     * @param string: encryption key
     *
     * @return bool
     */
    public function setKey ($key) {
	$this->key = $key;
	return true;
    }

    /* encrypt string
     * @param string: input
     * +@param string: encryption key
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

    /* decrypt string
     * @param string: input
     * +@param string: encryption key
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
