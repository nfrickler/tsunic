<!-- | User class -->
<?php
include_once '$system$Object.class.php';
class $$$User extends $system$Object {

    /* Homehost
     * OBJECT
     */
    protected $Homehost;

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
	if ($id == 'root') $id = 1;
	if ($id == 'guest') $id = 2;

	// is logged in?
	if (
	    empty($id) and
	    isset($_SESSION['$$$id__account'],
		$_SESSION['$$$passphrase']) and
	    !empty($_SESSION['$$$id__account']) and
	    !empty($_SESSION['$$$passphrase'])
	) {
	    $id = $_SESSION['$$$id__account'];
	    $this->_loadEncryption($_SESSION['$$$passphrase']);
	    $this->getInfo(true, true);
	}

	// use guest as default
	if (empty($id) or !$this->_validate($id, 'int')) $id = 2;

	return parent::__construct($id);
    }

    /* get SQL query to get object information from database
     *
     * @return sql-query
     */
    protected function loadInfoSql () {
	global $TSunic;
	return "SELECT ".
	    (($this->isLoggedIn() or $TSunic->Usr->access('$$$seeAllData')) ?
		"email as email,
		dateOfRegistration as dateOfRegistration,
		dateOfChange as dateOfChange,
		dateOfDeletion as dateOfDeletion,
		userkey as userkey,
	    " : "")."
		fk__homehost as fk__homehost,
		name as name
	    FROM #__accounts
	    WHERE id = '$this->id'
	;";
    }

    /* register user
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

	// create new account
	$sql = "INSERT INTO #__accounts
	    SET email = '$email',
		name = '$name',
		password = '".$this->_password2hash($password, $email)."',
		dateOfRegistration = NOW(),
		fk__homehost = 0
	;";
	return $this->_create($sql);
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
	    !$this->isValidName($name)
	) {
	    return false;
	}

	// has sth changed?
	$sql_set = array();
	if ($email != $this->getInfo('email')) {
	    $sql_set[] = "email = '$email'";
	}
	if ($name != $this->getInfo('name')) {
	    $sql_set[] = "name = '$name'";
	}
	if (!empty($password)) {
	    if (!$this->isValidPassword($password)) return false;
	    $sql_set[] = "password = '".$this->_password2hash($password, $email)."'";
	    if (!$this->_setEncPassword($this->_getPassphrase($password, $email))) return false;

	    # if root password is set, note in config
	    if ($this->isRoot()) $this->getConfig()->setDefault('$$$isRootPassword', 1);
	}
	if (empty($sql_set)) return true;

	// update database
	$sql = "UPDATE #__accounts SET ".
	    implode(", ", $sql_set).
	    " WHERE id = '$this->id';";
	return $this->_edit($sql);
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
	$sql = "DELETE FROM #__accounts
	    WHERE id = '$this->id';";
	if (!$this->_delete($sql)) return false;

	return true;
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
	$this->_loadEncryption($passphrase);

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
	return (empty($this->Encryption)) ? false : true;
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

    /* Load encryption object
     *
     * @return bool
     */
    protected function _loadEncryption ($passphrase) {
	global $TSunic;
	$this->Encryption = $TSunic->get('$$$Encryption', $passphrase);
	return true;
    }

    /* Set encryption passphrase
     * @param string: new passphrase
     *
     * @return bool
     */
    protected function _setEncPassword ($new_passphrase) {
	global $TSunic;

	// get userkey
	$userkey = $this->decrypt($this->getInfo('userkey'));

	// create new userkey
	if (empty($userkey)) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    for ($i = 0; $i < 50; $i++) {
		$userkey.= $characters[mt_rand(0, (strlen($characters)-1))];
	    }
	}

	// create new encryption object and encrypt userkey
	$this->Encryption = $TSunic->get('$$$Encryption', $new_passphrase);
	$userkey = $this->encrypt($userkey, false);

	// update database
	$sql = "UPDATE #__accounts
	    SET userkey = '$userkey'
	    WHERE id = '$this->id';";
	$result = $TSunic->Db->doUpdate($sql);
	if (!$result) return false;

	return true;
    }

    /* encrypt input
     * @param string: input
     *
     * @return string
     */
    public function encrypt ($input) {
	if (!$this->Encryption) return $input;
	return $this->Encryption->encrypt($input);
    }

    /* decrypt input
     * @param string: input
     *
     * @return string
     */
    public function decrypt ($input) {
	if (!$this->Encryption) return $input;
	return $this->Encryption->decrypt($input);
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
