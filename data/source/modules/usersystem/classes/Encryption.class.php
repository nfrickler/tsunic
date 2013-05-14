<!-- | CLASS Encryption -->
<?php
/** Handle encryption
 *
 * This class handles the encryption of all data of a user.
 */
class $$$Encryption {

    /** EncryptionClass object
     * @var object $MyEnc
     */
    private $MyEnc;

    /** Fk_account
     * @var int $fk_account
     */
    private $fk_account;

    /** Passphrase the keys are encrypted with
     * @var string $passphrase
     */
    private $passphrase;

    /** Encryption infix
     * @var string $infix
     */
    private $infix = '#infix#';

    /** Symmetric encryption prefix
     * @var string $prefix_sym
     */
    private $prefix_sym = '#prefix_sym#';

    /** Asymmetric encryption prefix
     * @var string $prefix_asym
     */
    private $prefix_asym = '#prefix_asym#';

    /** Symmetric key of user
     * @var strings $symkey
     */
    private $symkey;

    /** Private key of user
     * @var strings $privkey
     */
    private $privkey;

    /** Public key of user
     * @var strings $pubkey
     */
    private $pubkey;

    /** Ready for encryption?
     * @var bool $ready
     */
    private $ready = false;

    /** Constructor
     * @param int $fk_account
     *	fk_account
     * @param string $passphrase
     *	Passphrase the keys are encrypted with symmetrically
     */
    public function __construct ($fk_account, $passphrase = false) {
	global $TSunic;

	// save
	$this->passphrase = $passphrase;
	$this->fk_account = $fk_account;

	// try to load encryption object of chosen encryption
	$this->MyEnc = $TSunic->get(
	   '$$$Encryption_'.$TSunic->Config->get('encryption_class'),
	    array(
		$TSunic->Config->get('encryption_algorithm'),
		$TSunic->Config->get('encryption_mode')
	    )
	);
	if (!$this->MyEnc) {
	    // object could not be created
	    $TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
	}

	return;
    }

    /** Set passphrase
     * @param string $passphrase
     *	New passphrase
     *
     * @return bool
     */
    public function setPassphrase ($passphrase) {
	$this->passphrase = $passphrase;
	return true;
    }

    /** Generate new keys
     *
     * @return array
     */
    public function gen_keys () {
	global $TSunic;

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

    /** Get keys (encrypted)
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

    /** Set keys
     * @param string $symkey
     *	Symmetric key
     * @param string $privkey
     *	Private key
     * @param string $pubkey
     *	Public key
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

    /** Encrypt data
     * @param string $text
     *	Text to encrypt
     * @param string $key
     *	Key to be used
     * @param bool $asym
     *	Use asymmetric encryption (if key exists, this is forced)?
     *
     * @return string
     */
    public function encrypt ($text, $key = false, $asym = false) {
	global $TSunic;

	// do not encrypt for guest user
	if ($this->fk_account == $TSunic->Usr->getIdGuest()) return $text;

	// is ready for encryption?
	if (!$key and !$this->ready) $this->throwEncError();

	// do not encrypt empty text
	if ($text === '' or $text === false) return $text;

	// add infix
	$text = $this->infix.$text;

	// start timer
	$TSunic->Stats->startTimer('encryption');

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

	// stop timer
	$TSunic->Stats->stopTimer('encryption');

	return $text;
    }

    /** Decrypt data
     * @param string $text
     *	Text to decrypt
     * @param string $key
     *	Key to be used
     *
     * @return string
     */
    public function decrypt ($text, $key = false) {
	global $TSunic;
	$text_in = $text;

	// get encryption prefix
	if (substr($text, 0, strlen($this->prefix_sym)) == $this->prefix_sym) {
	    // get key
	    if (empty($key)) $key = $this->symkey;
	    if (empty($key)) return $text;

	    // is ready for encryption?
	    if (!$key and !$this->ready) $this->throwEncError();

	    // remove prefix
	    $text = substr($text, (strlen($this->prefix_sym)));

	    // start timer
	    $TSunic->Stats->startTimer('encryption');

	    // decrypt symmetric
	    $text = $this->MyEnc->decrypt(base64_decode($text), $key);

	    // stop timer
	    $TSunic->Stats->stopTimer('encryption');

	} elseif (substr($text, 0, strlen($this->prefix_asym)) == $this->prefix_asym) {

	    // get key
	    if (empty($key)) $key = $this->privkey;
	    if (empty($key)) return $text;

	    // is ready for encryption?
	    if (!$key and !$this->ready) $this->throwEncError();

	    // remove prefix
	    $text = substr($text, (strlen($this->prefix_asym)));

	    // start timer
	    $TSunic->Stats->startTimer('encryption');

	    // decrypt asymmetric
	    $crypttext = base64_decode($text);
	    $key = openssl_pkey_get_private($key);
	    openssl_private_decrypt($crypttext, $text, $key);

	    // stop timer
	    $TSunic->Stats->stopTimer('encryption');
	}

	// check infix
	if (substr($text, 0, strlen($this->infix)) == $this->infix) {
	    $text = substr($text, strlen($this->infix));
	} else {
	    // Decryption failed! Return original text
	    $text = $text_in;
	}

	return $text;
    }

    /** Throw encryption error
     */
    protected function throwEncError () {
	$TSunic->Log->log(1, 'Encryption called, but not ready yet!');
	$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
    }
}
?>
