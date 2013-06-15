<!-- | CLASS User -->
<?php
/** User management
 *
 * This class handles the user management.
 */
class $$$User extends $system$Object {

    /** Table
     * @var string $table
     */
    protected $table = "#__$usersystem$accounts";

    /** Login object
     * @var Login $Login
     */
    protected $Login;

    /** Access object
     * @var Access $Access
     */
    protected $Access;

    /* UserConfig object
     * @var UserObject $Config
     */
    protected $Config;

    /** Encryption object
     * @var Encryption $Encryption
     */
    protected $Encryption = NULL;

    /** Define id of root
     * @var int $id_root
     */
    protected $id_root = 1;

    /** Define id of guest
     * @var int $id_guest
     */
    protected $id_guest = 2;

    /** Constructor
     * If id is empty, this object represents the current user.
     *
     * @param int|string $id
     *	Account ID (or "guest", "root")
     */
    public function __construct ($id = false) {
	global $TSunic;
	$emptyid = (empty($id)) ? true : false;
	if ($id == 'root') $id = $this->id_root;
	if ($id == 'guest') $id = $this->id_guest;

	// check login
	if ($emptyid) {

	    // get Login object
	    $this->Login = $TSunic->get('$$$Login');

	    // get id of user
	    if ($this->Login->isValid())
		$id = $this->Login->getInfo('fk_user');
	    else
		$id = $this->id_guest;
	}

	// run object constructor
	parent::__construct($id);

	// get Encryption object
	$this->Encryption = $TSunic->get('$$$Encryption', NULL, true);

	// init Encryption
	if ($this->Login) {
	    $this->Login->authorizeEncryption($this->Encryption);
	    $this->Encryption->setKeys(
		$this->getInfo('symkey'),
		$this->getInfo('privkey'),
		$this->getInfo('pubkey')
	    );
	} else {
	    $this->Encryption =
		$TSunic->get('$$$Encryption', NULL, true);
	    $this->Encryption->setKeys(
		false,
		false,
		$this->getInfo('pubkey')
	    );
	}
    }

    /** Get username of this user
     *
     * @return string
     */
    public function getName () {
	return $this->getInfo('name');
    }

    /** Create new user
     * @param string $email
     *	Email
     * @param string $name
     *	Name
     * @param string $password
     *	Password
     *
     * @return bool
     */
    public function create ($email, $name, $password) {
	global $TSunic;

	// validate input
	if (!$this->isValidEMail($email) or
	    !$this->isValidName($name) or
	    !$this->isValidPassword($password)
	) {
	    return false;
	}

	// For security reasons the root account has to be protected
	// with a password before any other user can register
	if (!$this->getConfig()->getDefault('$$$isRootPassword')) {
	    global $TSunic;
	    $TSunic->Log->alert('error', '{ISROOTPASSWORD__FAILED}');
	    return false;
	}

	// create Login
	$this->Login = $TSunic->get('$$$Login');

	// set passphrase
	$salt = $this->Encryption->getRandom(50);
	$enckey = $this->plaintext2enc($password, $salt);
	$this->Encryption->setPassphrase($enckey);

	// generate new keys
	$newkeys = $this->Encryption->gen_keys();

	// temporarily unset $this->id
	$old_id = $this->id;
	$this->id = 0;

	// update database
	$data = array(
	    "email" => $email,
	    "name" => $name,
	    "salt" => $salt,
	    "password" => $this->plaintext2login($password, $salt),
	    "dateOfRegistration" => "NOW()",
	    "symkey" => $newkeys['symkey'],
	    "privkey" => $newkeys['privkey'],
	    "pubkey" => $newkeys['pubkey']
	);
	$return = $this->_create($data);
	if (!$return) {
	    $this->id = $old_id;
	    return false;
	}

	return true;
    }

    /** Edit account
     * @param string $email
     *	New e-mail
     * @param string $name
     *	New name
     * @param string $password
     *	New password
     *
     * @return bool
     */
    public function edit ($email, $name, $password) {
	global $TSunic;

	// access?
	if ($this->id != $TSunic->Usr->getInfo('id')
	    AND !$TSunic->Usr->access('$$$editAllUsers')
	) return false;

	// validate input
	if (!$this->isValidEMail($email) or
	    !$this->isValidName($name) or
	    !$this->isValidPassword($password)
	) {
	    return false;
	}

	// update encryption keys
	$salt = $this->Encryption->getRandom(50);
	$enckey = $this->plaintext2enc($password, $salt);
	$this->Encryption->setPassphrase($enckey);
	$newkeys = $this->Encryption->getKeys();

	// generate new keys, if not generated yet (for root)
	if (empty($newkeys['symkey'])) {
	    $newkeys = $this->Encryption->gen_keys();
	}

	// update database
	$data = array(
	    "email" => $email,
	    "name" => $name,
	    "salt" => $salt,
	    "password" => $this->plaintext2login($password, $salt),
	    "symkey" => $newkeys['symkey'],
	    "privkey" => $newkeys['privkey'],
	    "pubkey" => $newkeys['pubkey'],
	);
	if (!$this->_edit($data)) return false;

	// Renew login
	$this->Login->logout();
	$this->Login = $TSunic->get('$$$Login');
	if (!$this->Login->login($email, $password)) return false;

	# if root password is set, note in config
	if ($this->isRoot()) {
	    $this->getConfig()->setDefault('$$$isRootPassword', 1);
	}

	return true;
    }

    /** Delete account
     *
     * @return bool
     */
    public function delete () {
	global $TSunic;

	// root or guest?
	if ($this->isRoot() or $this->isGuest()) return false;

	// access?
	if ($this->id != $TSunic->Usr->getInfo('id')
	    AND !$TSunic->Usr->access('$$$deleteAllUsers')
	) return false;

	// remove in database
	return $this->_delete();
    }

    /** Log user in
     * @param string $email
     *	Name or email of user
     * @param string $password
     *	Password of user
     *
     * @return bool
     */
    public function login ($emailname, $password) {
	global $TSunic;

	// deny, if not current user
	if (!$this->Login) return false;

	// try to login
	$id = $this->Login->login($emailname, $password);
	if (empty($id)) return false;

	// update user data
	$this->id = $id;
	$this->getInfo(true, true);

	// load encryption
	$this->Login->authorizeEncryption($this->Encryption);

	return true;
    }

    /** Convert plaintext password to login hash
     * @param string $password
     *  Plaintext password
     * @param string $salt
     *	Add optional salt (otherwise the salt of this User is used)
     *
     * @return string
     */
    public function plaintext2login ($plaintext, $salt = false) {
	if (!$salt) $salt = $this->getInfo('salt');
	return $this->Encryption->hash($plaintext.$salt);
    }

    /** Convert plaintext password to encryption hash
     * @param string $password
     *  Plaintext password
     * @param string $salt
     *	Add optional salt (otherwise the salt of this User is used)
     *
     * @return string
     */
    public function plaintext2enc ($plaintext, $salt = false) {
	if (!$salt) $salt = $this->getInfo('salt');
	return $this->Encryption->hash($salt.$plaintext);
    }

    /** Is correct password?
     *
     * @return bool
     */
    public function isCorrectPassword ($password) {
	return ($this->Login and $this->Login->validate(
	    $this->getInfo('email'), $password
	)) ? true : false;
    }

    /** Log out user
     *
     * @return bool
     */
    public function logout () {

	// deny, if not current user
	if (!$this->Login) return true;

	// logout
	if (!$this->Login->logout()) return false;
	$this->Encryption = NULL;

	return true;
    }

    /** Is user logged in?
     *
     * @return bool
     */
    public function isLoggedIn () {
	return ($this->Login and $this->Login->isValid()) ? true : false;
    }

    /** Is registered user?
     *
     * @return bool
     */
    public function isRegistered () {
	return (!$this->isRoot() and
	    !$this->isDefault() and
	    !$this->isGuest()
	) ? true : false;
    }

    /** Is user root?
     *
     * @return bool
     */
    public function isRoot () {
	return ($this->id == $this->id_root) ? true : false;
    }

    /** Is user guest?
     *
     * @return bool
     */
    public function isGuest () {
	return ($this->id == $this->id_guest) ? true : false;
    }

    /** Get id of guest
     *
     * @return int
     */
    public function getIdGuest () {
	return $this->id_guest;
    }

    /** Is valid e-mail?
     * @param string $email
     *	E-mail address
     *
     * @return bool
     */
    public function isValidEMail ($email) {
	global $TSunic;
	if (!$this->_validate($email, 'email')) return false;

	// check if e-mail is unique
	$sql = "SELECT id as id
	    FROM #__$usersystem$accounts
	    WHERE email = '$email';";
	$result = $TSunic->Db->doSelect($sql);
	if (!empty($result) and $result[0]['id'] != $this->id) return false;
	return true;
    }

    /** Is valid name?
     * @param string $name
     *	Name
     *
     * @return bool
     */
    public function isValidName ($name) {
	global $TSunic;
	if (strlen($name) < 3 or strlen($name) > 30) return false;
	if (!$this->_validate($name, 'string')) return false;

	// check if name is unique
	$sql = "SELECT id as id
	    FROM #__$usersystem$accounts
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if (!empty($result) and $result[0]['id'] != $this->id) return false;
	return true;
    }

    /** Is valid password?
     * @param string $password
     *	Password
     *
     * @return bool
     */
    public function isValidPassword ($password) {
	return $this->_validate($password, 'password');
    }

    /** Encrypt data
     * @param string $input
     *	String to be encrypted
     * @param string $key
     *	Encryption key
     * @param bool $asym
     *	Use asymmetric encryption?
     *
     * @return string
     */
    public function encrypt ($input, $key = false, $asym = false) {
	global $TSunic;

	// do not encrypt for guest
	if ($this->isGuest()) return $input;

	// if not current user, use asym only!
	if ($TSunic->Usr->getInfo('id') != $this->id) $asym = true;

	return $this->Encryption->encrypt($input, $key, $asym);
    }

    /** Decrypt input
     * @param string $input
     *	String to be decrypted
     * @param string $key
     *	Decryption key
     *
     * @return string
     */
    public function decrypt ($input, $key = false) {
	return $this->Encryption->decrypt($input, $key);
    }

    /** Has user access?
     * @param string $name
     *	Name of access
     *
     * @return bool
     */
    public function access ($name) {
	return $this->getAccess()->check($name);
    }

    /** Get access object of user
     *
     * @return bool
     */
    public function getAccess () {
	if (!$this->Access) {
	    global $TSunic;
	    $this->Access = $TSunic->get('$$$Access', $this->id);
	}
	return $this->Access;
    }

    /** Get config value of user
     * @param string $name
     *	Name of config
     * @param bool $returnDefault
     *	Return default, if no userconfig?
     *
     * @return mix
     */
    public function config ($name, $returnDefault = true) {
	return $this->getConfig()->get($name, $returnDefault);
    }

    /** Set config value of user
     * @param string $name
     *	Name of config
     * @param mix $value
     *	Value
     *
     * @return bool
     */
    public function setConfig ($name, $value) {
	return $this->getConfig()->set($name, $value);
    }

    /** Get UserConfig object
     *
     * @return UserConfig
     */
    public function getConfig () {
	if (!$this->Config) {
	    global $TSunic;
	    $this->Config = $TSunic->get('$$$UserConfig', $this->id);
	}
	return $this->Config;
    }

    /** Get all users
     *
     * @return array
     */
    public function allUsers () {
	global $TSunic;

	// get all users from database
	$sql = "SELECT id, name
	    FROM #__$usersystem$accounts;";
	$results = $TSunic->Db->doSelect($sql);
	if (!$results) return array();

	// create output array
	$output = array();
	foreach ($results as $index => $values) {
	    $output[$values['id']] = $values['name'];
	}

	return $output;
    }
}
?>
