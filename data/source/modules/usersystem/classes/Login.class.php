<!-- | CLASS Login -->
<?php
/** Login management
 *
 * This class handles the login of users.
 * There are several states of the password:
 *  1. plaintext
 *  4. hash in user-table (= hash(plaintext+salt)) )
 *  2. passphrase for encryption (= hash(salt+plaintext) )
 *  3. tmpphrase (= encrypt_with_tmpkey(passphrase) )
 */
class $$$Login extends $system$Object {

    /** Table
     * @var string $table
     */
    protected $table = "#__$usersystem$logins";

    /** Encrypt values in database?
     * @var bool $enableEncryption
     */
    protected $enableEncryption = false;

    /** Encryption passphrase encrypted with tmpkey
     * @var string $enchash
     */
    protected $enchash;

    /** Constructor
     * @param int $id
     *	ID of Login
     */
    public function __construct ($id = false) {
	global $TSunic;

	// no id specified?
	if ($id === false) {

	    // get login data from session
	    if (isset(
		$_SESSION['$$$login__id'], $_SESSION['$$$login__enchash']
	    )) {
		$id = $_SESSION['$$$login__id'];
		$this->enchash = $_SESSION['$$$login__enchash'];
	    }
	}

	parent::__construct($id);

	if ($this->id) {
	    $this->set('dateOfLast', 'NOW()', true);
	}
    }

    /** Get id of logged in user
     *
     * @return int
     */
    public function getUserId () {
	return $this->getInfo('fk_user');
    }

    /** Authorize encryption object
     * @param Encryption $Encryption
     *  Encryption object
     *
     * @return bool
     */
    public function authorizeEncryption ($Encryption) {
	if (!$this->enchash or !$this->isValid()) return false;

	// decrypt tmpkey to enckey
	$tmpkey = $this->getInfo('tmpkey');
	$enckey = $Encryption->decrypt(
	    $this->enchash, $tmpkey
	);

	// initialize Encryption object
	$Encryption->setPassphrase($enckey);
    }

    /** Create new login session.
     * Returns the id of the user logged in or 0, if login failed
     *
     * @param string $email
     *	Name or email of user
     * @param string $password
     *	Password of user
     *
     * @return int
     */
    public function login ($emailname, $password) {
	global $TSunic;
	$Encryption = $TSunic->get('$$$Encryption');

	// validate login
	$id = $this->validate($emailname, $password);

	// create new Login
	$tmpkey = $Encryption->getRandom(50);
	$data = array(
	    'fk_user' => $id,
	    'emailname' => $emailname,
	    'tmpkey' => $tmpkey,
	    'ip' => '',
	    'browser' => '',
	    'dateOfLogin' => 'NOW()',
	    'dateOfLast' => 'NOW()',
	);
	if (!$this->setMulti($data, true)) {
	    $TSunic->Log->log(1,
		'Login::create: Login information could not be saved!'
	    );
	}

	// success?
	if ($id) {

	    // get salt of current user (we cannot use $TSunic->Usr as
	    // this object is still guest!)
	    $User = $TSunic->get('$$$User', $id);
	    $salt = $User->getInfo('salt');

	    // update session
	    $enchash = $Encryption->encrypt(
		$TSunic->Usr->plaintext2enc($password, $salt),
		$tmpkey
	    );
	    session_regenerate_id();
	    $_SESSION['$$$login__id'] = $this->id;
	    $_SESSION['$$$login__enchash'] = $enchash;
	}

	return $id;
    }

    /** Validate e-mail/name password combination to be valid login data.
     * Returns the id of the matching account or 0, if login is invalid.
     *
     * @param string $emailname
     *	E-mail or name of user
     * @param string $password
     *	Plaintext password
     *
     * @return int
     */
    public function validate ($emailname, $password) {
	global $TSunic;
	$id = 0;

	// try to get salt of user
	$sql = "SELECT salt
	    FROM #__$usersystem$accounts
	    WHERE email = '$emailname' OR name = '$emailname'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result or count($result) != 1) return 0;
	$salt = $result[0]['salt'];

	$loginhash = (empty($password))
	    ? '' : $TSunic->Usr->plaintext2login($password, $salt);
	$sql = "SELECT id as id
	    FROM #__$usersystem$accounts
	    WHERE (email = '$emailname' OR name = '$emailname')
		AND password = '$loginhash'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get id
	if ($result and count($result)) $id = $result[0]['id'];

	// deny login for guest
	if ($id == 2) $id = 0;

	return $id;
    }

    /** Logout user and end this session
     *
     * @return bool
     */
    public function logout () {
	$_SESSION['$$$login__id'] = 0;
	$_SESSION['$$$login__enchash'] = 0;
	session_unset();
	session_regenerate_id();
    }

    /** Is valid Login?
     *
     * @return bool
     */
    public function isValid () {
	return ($this->getInfo('fk_user')) ? true : false;
    }
}
?>
