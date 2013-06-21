<!-- | CLASS Encryption -->
<?php
/** Handle encryption
 *
 * This class handles the encryption of all data of a user and is based on
 * openssl
 */
class $$$Encryption {

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

    /** Symmetric encryption algorithm
     * @var string $symmethod
     */
    private $symmethod = 'aes-256-cbc';

    /** Hashing algorithm
     * @var string $hashmethod
     */
    private $hashmethod = 'sha512';

    /** Constructor
     * @param string $passphrase
     *	Passphrase the keys are encrypted with symmetrically
     */
    public function __construct ($passphrase = false) {
	global $TSunic;

	// save
	$this->passphrase = $passphrase;
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
	$this->symkey = $this->getRandom(50);

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

	// is ready for encryption?
	if (!$key and !$this->ready) $this->throwEncError();

	// do not encrypt empty text
	if ($text === '' or $text === false) {
	    return $text;
	}

	// add infix
	$text = $this->infix.$text;

	// start timer
	$TSunic->Stats->startTimer('encryption');

	// encrypt
	if (!$asym) {
	    // encrypt symmetric

	    // get key
	    if (empty($key)) $key = $this->symkey;

	    // get initialization vector
	    $iv = openssl_random_pseudo_bytes(16);

	    // encrypt
	    $text = openssl_encrypt($text, $this->symmethod, $key, 0, $iv);

	    // add prefix
	    $text = $this->prefix_sym.base64_encode($iv).'__'.$text;

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

	    // get initialization vector
	    $iv = strtok($text, '__');
	    $text = substr($text, strlen($iv)+2);
	    $iv = base64_decode($iv);

	    // decrypt symmetric
	    $text = openssl_decrypt($text, $this->symmethod, $key, 0, $iv);

	    // stop timer
	    $TSunic->Stats->stopTimer('encryption');

	} elseif (
	    substr($text, 0, strlen($this->prefix_asym)) == $this->prefix_asym
	) {

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
	$TSunic->Log->log(1, 'usersystem:Encryption: Encryption called, but not ready yet!');
	$TSunic->throwError('{ERROR_NO_ENCRYPTION_FOUND}');
    }

    /** Get random string (cryptographically)
     * @param int $length
     *	Length of random string
     *
     * @return string
     */
    public function getRandom ($length) {
	return substr(base64_encode(
	    openssl_random_pseudo_bytes($length)
	), 0, $length);
    }

    /** Get hashed password (bcrypt)
     * @param string $password
     *	Password to be hashed
     * @param string $salt
     *	Salt to use for hashing. An empty salt will use a newly created
     *	random one
     * @param int $iterations
     *  Number of iterations used by bcrypt
     *
     * @return string
     */
    public function hash ($password, $salt = '', $iterations = 8) {

	// pad iterations
	if ($iterations < 10) $iterations = '0'.$iterations;

	// create new salt
	if (empty($salt)) $salt = $this->newSalt();

	// hash it with bcrypt
	return crypt($password, '$2a$'.$iterations.'$'.$salt);
    }

    /** Verify hashed password (bcrypt)
     * @param string $password
     *	Password to be hashed
     * @param string $hash
     *	Hash to compare against
     *
     * @return bool
     */
    public function verifyHash ($password, $hash) {

	// compute hash of password using same salt as in $hash
	$pwhash = $this->hash($password, $this->extractSalt($hash));

	// compare pwhash with actual hash
	// TODO: Prevent timing attack!
	return ($pwhash == $hash) ? true : false;
    }

    /** Extract salt from bcrypt hash
     * @param string $hash
     *	Bcrypt hash
     *
     * @return string
     */
    public function extractSalt ($hash) {
	return substr($hash, 7, 22);
    }

    /** Create a new random salt for bcrypt
     * @param array $nogos
     *	List of salts that are not accepted as result (e.g. to prevent doubles)
     *
     * @return string
     */
    public function newSalt ($nogos = array()) {
	if (!is_array($nogos)) $nogos = array();
	$salt = substr(str_replace('+', '.', base64_encode(
	    openssl_random_pseudo_bytes(16)
	)), 0, 22);
	return (in_array($salt, $nogos)) ? $this->newSalt($nogos) : $salt;
    }
}
?>
