<!-- | CLASS User -->
<?php
class $$$User extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__accounts";

    /* Connection
     * OBJECT
     */
    protected $Connection;

    /* Access
     * OBJECT
     */
    protected $Access;

    /* Filesystem
     * OBJECT
     */
    protected $Filesystem;

    /* Userconfig
     * OBJECT
     */
    protected $Config;

    /* Profile
     * OBJECT
     */
    protected $Profile;

    /* Contacts
     * OBJECT
     */
    protected $Contacts;

    /* Usermodules
     * OBJECT
     */
    protected $Usermodules;

    /* Encryption
     * OBJECT
     */
    protected $Encryption = NULL;

    /* constructor
     * @param int/string: account ID (or "guest", "root")
     */
    public function __construct ($id = false) {
	global $TSunic;
	if ($id == 'root') $id = 1;
	if ($id == 'guest') $id = 2;
	if (isset($_SESSION['$$$id__account']))
	    $id = $_SESSION['$$$id__account'];

	// use guest as default
	if (empty($id) or !$this->_validate($id, 'int')) $id = 2;

	// run object constructor
	parent::__construct($id);

	// load Encryption
	$this->Encryption = $TSunic->get('$$$Encryption', $this->id);
	if (isset($_SESSION['$$$passphrase'])) {
	    $this->Encryption->setPassphrase($_SESSION['$$$passphrase']);
	    $this->Encryption->setKeys(
		$this->getInfo('symkey'),
		$this->getInfo('privkey'),
		$this->getInfo('pubkey')
	    );
	} else {
	    $this->Encryption->setKeys(
		false,
		false,
		$this->getInfo('pubkey')
	    );
	}

	return;
    }

    /* create new user
     * @param string: email
     * @param string: name
     * @param string: password
     *
     * @return bool
     */
    public function create ($email, $name, $password) {

	// validate input
	if (!$this->isValidEMail($email) or
	    !$this->isValidName($name) or
	    !$this->isValidPassword($password)
	) {
	    return false;
	}

	// is root password set?
	if (!$this->getConfig()->getDefault('$$$isRootPassword')) {
	    global $TSunic;
	    $TSunic->Log->alert('error', '{ISROOTPASSWORD__FAILED}');
	    return false;
	}

	// generate new keys
	$newkeys = $this->Encryption->gen_keys();

	// update database
	$data = array(
	    "email" => $email,
	    "name" => $name,
	    "password" => $this->_password2hash($password, $email),
	    "dateOfRegistration" => "NOW()",
	    "symkey" => $newkeys['symkey'],
	    "privkey" => $newkeys['privkey'],
	    "pubkey" => $newkeys['pubkey']
	);
	return $this->_create($data);
    }

    /* edit account
     * @param string: new e-mail
     * @param string: new name
     * @param string: new password
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
	$passphrase = $this->_getPassphrase($password, $email);
	$this->Encryption->setPassphrase($passphrase);
	$newkeys = $this->Encryption->getKeys();

	// generate new keys, if not generated yet (for root)
	if (empty($newkeys['symkey'])) {
	    $newkeys = $this->Encryption->gen_keys();
	}

	// update database
	$data = array(
	    "email" => $email,
	    "name" => $name,
	    "password" => $this->_password2hash($password, $email),
	    "symkey" => $newkeys['symkey'],
	    "privkey" => $newkeys['privkey'],
	    "pubkey" => $newkeys['pubkey'],
	);

	# if root password is set, note in config
	if ($this->isRoot()) $this->getConfig()->setDefault('$$$isRootPassword', 1);

	return $this->_edit($data);
    }

    /* delete account
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

    /* get email to name
     * @param string: name
     *
     * @return string
     */
    public function name2email ($name) {
	global $TSunic;
	if ($this->_validate($name, 'email')) return $name;
	if (!$this->_validate($name, 'string')) return false;

	// ask database
	$sql = "SELECT email as email
	    FROM #__accounts
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;

	return $result[0]['email'];
    }

    /* log user in
     * @param string: name or email of user
     * @param string: password of user
     *
     * @return bool
     */
    public function login ($email, $password) {
	global $TSunic;

	// try to get user with matching identity
	$email = $this->name2email($email);
	$sql = "SELECT id as id
	    FROM #__accounts
	    WHERE email = '$email'
		AND password = '".$this->_password2hash($password, $email)."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;

	// save id
	$this->id = $result[0]['id'];

	// deny login for guest account!
	if ($this->id == 2) return false;

	// update database
	$sql = "UPDATE #__accounts
	    SET dateOfLastLogin = NOW(),
		dateOfLastLastLogin = '".$this->getInfo('dateOfLastLogin')."'
	    WHERE id = '".$this->id."';";
	if ($TSunic->Db->doUpdate($sql) === false) {
	    $TSunic->Log->log('Login information could not be updated!', 3);
	}

	// load encryption
	$passphrase = $this->_getPassphrase($password, $email);
	$this->Encryption = $TSunic->get('$$$Encryption', array($this->id, $passphrase));

	// get session
	$_SESSION['$$$id__account'] = $this->id;
	$_SESSION['$$$passphrase'] = $passphrase;

	// update account data
	$this->getInfo(true, true);

	return true;
    }

    /* is correct password?
     *
     * @return bool
     */
    public function isCorrectPassword ($password) {
	global $TSunic;

	// try to get user with matching identity
	$sql = "SELECT id as id
	    FROM #__accounts
	    WHERE id = '$this->id'
		AND password = '".$this->_password2hash($password)."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;

	return ($result[0]['id'] == $this->id) ? true : false;
    }

    /* log user out
     *
     * @return bool
     */
    public function logout () {
	$_SESSION['$$$id__account'] = 0;
	$_SESSION['$$$passphrase'] = 0;
	$this->Encryption = NULL;
	return true;
    }

    /* convert password to hash
     * @param string: password of user
     * +@param string: email of user
     *
     * @return bool
     */
    protected function _password2hash ($password, $email = false) {
	if (empty($password)) return "";
	if (!$email) $email = $this->getInfo('email');
	return sha1(sha1(trim($email).trim($password)));
    }

    /* get passphrase of user
     * @param string: password of user
     * +@param string: email of user
     *
     * @return string
     */
    protected function _getPassphrase ($password, $email = false) {
	if (!$email) $email = $this->getInfo('email');
	return sha1($email.$password);
    }

    /* is user logged in?
     *
     * @return bool
     */
    public function isLoggedIn () {
	return (
	    isset($_SESSION['$$$passphrase']) and
	    !empty($_SESSION['$$$passphrase'])
	) ? true : false;
    }

    /* is registered user?
     *
     * @return bool
     */
    public function isRegistered () {
	return (!$this->isRoot() and
	    !$this->isDefault() and
	    !$this->isGuest())
	    ? true : false;
    }

    /* is user root?
     *
     * @return bool
     */
    public function isRoot () {
	return ($this->id == 1) ? true : false;
    }

    /* is user guest?
     *
     * @return bool
     */
    public function isGuest () {
	return ($this->id == 2) ? true : false;
    }

    /* is valid e-mail?
     * @param string: e-mail address
     *
     * @return bool
     */
    public function isValidEMail ($email) {
	global $TSunic;
	if (!$this->_validate($email, 'email')) return false;

	// check if e-mail is unique
	$sql = "SELECT id as id
	    FROM #__accounts
	    WHERE email = '$email';";
	$result = $TSunic->Db->doSelect($sql);
	if (!empty($result) and $result[0]['id'] != $this->id) return false;
	return true;
    }

    /* is valid name?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	global $TSunic;
	if (strlen($name) < 3 or strlen($name) > 30) return false;
	if (!$this->_validate($name, 'string')) return false;

	// check if name is unique
	$sql = "SELECT id as id
	    FROM #__accounts
	    WHERE name = '$name';";
	$result = $TSunic->Db->doSelect($sql);
	if (!empty($result) and $result[0]['id'] != $this->id) return false;
	return true;
    }

    /* is valid password?
     * @param string: password
     *
     * @return bool
     */
    public function isValidPassword ($password) {
	return $this->_validate($password, 'password');
    }

    /* encrypt input
     * @param string: input
     * +@param string: encryption key
     *
     * @return string
     */
    public function encrypt ($input, $key = false, $asym = false) {
	return $this->Encryption->encrypt($input, $key, $asym);
    }

    /* decrypt input
     * @param string: input
     * +@param string: decryption key
     *
     * @return string
     */
    public function decrypt ($input, $key = false) {
	return $this->Encryption->decrypt($input, $key);
    }

    /* has user access?
     * @param string: name of access
     *
     * @return bool
     */
    public function access ($name) {
	return $this->getAccess()->check($name);
    }

    /* get access object of user
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

    /* get config value of user
     * @param string: name of config
     * +@param bool: return default, if no userconfig?
     *
     * @return mix
     */
    public function config ($name, $returnDefault = true) {
	return $this->getConfig()->get($name, $returnDefault);
    }

    /* set config value of user
     * @param string: name of config
     * @param mix: value
     *
     * @return bool
     */
    public function setConfig ($name, $value) {
	return $this->getConfig()->set($name, $value);
    }

    /* get userconfig object
     *
     * @return OBJECT
     */
    public function getConfig () {
	if (!$this->Config) {
	    global $TSunic;
	    $this->Config = $TSunic->get('$$$UserConfig', $this->id);
	}
	return $this->Config;
    }

    /* get all users
     *
     * @return array
     */
    public function allUsers () {
	global $TSunic;

	// access?
	if (!$TSunic->Usr->access('$$$listAllUsers')) return array();

	// get all users from database
	$sql = "SELECT id, name
	    FROM #__accounts;";
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
