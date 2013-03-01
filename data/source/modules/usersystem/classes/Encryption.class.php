<!-- | CLASS handle encryption -->
<?php
class $$$Encryption {

    /* encryptionClass-object
     * object
     */
    private $MyEnc;

    /* fk_account
     * int
     */
    private $fk_account;

    /* passphrase the keys are encrypted with
     * string
     */
    private $passphrase;

    /* symmetric encryption prefix
     * string
     */
    private $prefix_sym = '#prefix_sym#';

    /* asymmetric encryption prefix
     * string
     */
    private $prefix_asym = '#prefix_asym#';

    /* keys of user
     * strings
     */
    private $symkey;
    private $privkey;
    private $pubkey;

    /* ready for encryption?
     * bool
     */
    private $ready = false;

    /* constructor
     * @param int: fk_account
     * +@param string: passphrase the keys are encrypted with symmetrically
     */
    public function __construct ($fk_account, $passphrase = false) {
	global $TSunic;

	// save
	$this->passphrase = $passphrase;
	$this->fk_account = $fk_account;

	// try to load encryption object of chosen encryption
	$this->MyEnc = $TSunic->get(
	    '$$$Encryption_'.$TSunic->Config->getConfig('encryption_class'),
	    array(
		$TSunic->Config->getConfig('encryption_algorithm'),
		$TSunic->Config->getConfig('encryption_mode')
	    )
	);
	if (!$this->MyEnc) {
	    // object could not be created
	    $TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
	}

	return;
    }

    /* set passphrase
     * @param string: new passphrase
     *
     * @return bool
     */
    public function setPassphrase ($passphrase) {
	$this->passphrase = $passphrase;
	return true;
    }

    /* generate new keys
     *
     * @return array
     */
    public function gen_keys () {

	// generate public/private keypair
	$res = openssl_pkey_new(array(
	    'digest_alg' => 'sha1',
	    'private_key_type' => OPENSSL_KEYTYPE_RSA,
	    'private_key_bits' => 2048
	));

	// get private key
	if (!openssl_pkey_export($res, $this->privkey)) {
	    $TSunic->throwError("openssl_pkey_export failed!");
	    exit;
	}

	// get public key
	$details = openssl_pkey_get_details($res);
	$this->pubkey = $details['key'];

	// generate symmetric key
	$this->symkey = '';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	for ($i = 0; $i < 50; $i++) {
	    $this->symkey.= $characters[mt_rand(0, (strlen($characters)-1))];
	}

	// ready
	$this->ready = true;

	return $this->getKeys();
    }

    /* get keys (encrypted)
     *
     * @return array
     */
    public function getKeys () {
	return array(
	    'symkey' => $this->encrypt($this->symkey, $this->passphrase),
	    'privkey' => $this->encrypt($this->privkey, $this->passphrase),
	    'pubkey' => $this->pubkey
	);
    }

    /* set keys
     * @param string: symmetric key
     * @param string: private key
     * @param string: public key
     *
     * @return bool
     */
    public function setKeys ($symkey, $privkey, $pubkey) {
	$this->symkey = $this->decrypt($symkey, $this->passphrase);
	$this->privkey = $this->decrypt($privkey, $this->passphrase);
	$this->pubkey = $pubkey;
	$this->ready = true;
	return true;
    }

    /* encrypt
     * @param string: text to encrypt
     * +@param string: key to be used
     * +@param bool: use asymmetric encryption (if key exists, this is
     * forced)?
     *
     * @return string
     */
    public function encrypt ($text, $key = false, $asym = false) {
	global $TSunic;

	// is ready for encryption?
	if (!$key and !$this->ready) $this->throwEncError();

	// do not encrypt empty text
	if ($text === '' or $text === false) return $text;

	// encrypt for other user?
	if (($key and !$asym) or $TSunic->Usr->getInfo('id') == $this->fk_account) {
	    // encrypt symmetric

	    // get key
	    if (empty($key)) $key = $this->symkey;

	    // encrypt
	    $text = base64_encode($this->MyEnc->encrypt($text, $key));

	    // add prefix
	    $text = $this->prefix_sym.$text;

	} else {
	    // encrypt asymmetric

	    // get key
	    if (empty($key)) $key = $this->pubkey;

	    // encrypt
	    $crypttext = $text;
	    openssl_public_encrypt($crypttext, $text, $key);
	    $text = base64_encode($text);

	    // add prefix
	    $text = $this->prefix_asym.$text;
	}

	return $text;
    }

    /* decrypt
     * @param string: text to decrypt
     * +@param string: key to be used
     *
     * @return string
     */
    public function decrypt ($text, $key = false) {
	global $TSunic;

	// get encryption prefix
	if (substr($text, 0, strlen($this->prefix_sym)) == $this->prefix_sym) {

	    // get key
	    if (empty($key)) $key = $this->symkey;

	    // is ready for encryption?
	    if (!$key and !$this->ready) $this->throwEncError();

	    // remove prefix
	    $text = substr($text, (strlen($this->prefix_sym)));

	    // decrypt symmetric
	    $text = $this->MyEnc->decrypt(base64_decode($text), $key);

	} elseif (substr($text, 0, strlen($this->prefix_asym)) == $this->prefix_asym) {

	    // get key
	    if (empty($key)) $key = $this->privkey;

	    // is ready for encryption?
	    if (!$key and !$this->ready) $this->throwEncError();

	    // remove prefix
	    $text = substr($text, (strlen($this->prefix_asym)));

	    // decrypt asymmetric
	    $crypttext = base64_decode($text);
	    $key = openssl_pkey_get_private($key);
	    openssl_private_decrypt($crypttext, $text, $key);
	}

	return $text;
    }

    /* throw encryption error
     *
     */
    protected function throwEncError () {
	$TSunic->Log->log(1, 'Encryption called, but not ready yet!');
	$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
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
}
?>
