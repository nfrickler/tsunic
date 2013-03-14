<!-- | CLASS key -->
<?php
class $$$Key {

    /* fk_table
     * string
     */
    protected $fk_table;

    /* id of entry
     * int
     */
    protected $fk_id;

    /* id of account
     * int
     */
    protected $fk_account;

    /* information about key
     * array
     */
    protected $info;

    /* constructor
     * @param string: name of table
     * @param int: id of entry
     */
    public function __construct ($fk_table, $fk_id, $fk_account = 0) {
	global $TSunic;

	// save
	$this->fk_table = $fk_table;
	$this->fk_id = $fk_id;
	$this->fk_account = ($fk_account) ? $fk_account : $TSunic->Usr->getInfo('id');
    }

    /* get information about key
     * @param string: name of info
     *
     * @return mix
     */
    public function getInfo ($name) {
	global $TSunic;

	// onload data
	if (empty($this->info)) $this->_loadInfo();
	if (empty($this->info)) return false;

	// return requested info
	if (isset($this->info[$name])) return $this->info[$name];

	return NULL;
    }

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!$this->fk_table or !$this->fk_id or !$this->fk_account)
	    return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT *
	    FROM #__keys
	    WHERE fk_table = '$this->fk_table'
		AND fk_id = '$this->fk_id'
		AND fk_account = '$this->fk_account'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;
	$this->info = $result[0];

	// decrypt key
	$this->info['key'] = $TSunic->Usr->decrypt($this->info['_key_']);
	unset($this->info['_key_']);

	return true;
    }

    /* encrypt data using this key
     * @param string: data
     */
    public function encrypt ($data) {
	global $TSunic;

	// get key
	$key = $this->getInfo('key');
	if (empty($key)) {

	    // create new key
	    $this->create();
	}

	// can_write?
	if (!$this->getInfo('can_write')) return $data;
	$data = $TSunic->Usr->encrypt($data, $this->getInfo('key'), false);
	return $data;
    }

    /* decrypt data using this key
     * @param string: data
     */
    public function decrypt ($data) {
	global $TSunic;

	// get key
	$key = $this->getInfo('key');
	if (empty($key)) return $data;

	// decrypt data
	$data = $TSunic->Usr->decrypt($data, $this->getInfo('key'));

	return $data;
    }

    /* get new random key phrase
     *
     * @return string
     */
    protected function gen_key () {
	$string = '';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	for ($i = 0; $i < 30; $i++) {
	    $string .= $characters[mt_rand(0, (strlen($characters)-1))];
	}
	return $string;
    }

    /* get key
     *
     * @return string
     */
    public function create () {
	global $TSunic;

	// create tmp info
	$this->info = array(
	    'fk_table' => $this->fk_table,
	    'fk_id' => $this->fk_id,
	    'fk_account' => $this->fk_account,
	    'fk_account_origin' => $TSunic->Usr->getInfo('id'),
	    'can_write' => 1,
	    'key' => $this->gen_key()
	);

	return true;
    }

    /* save new key in database
     * +@param int: fk_id
     *
     * @return bool
     */
    public function save ($fk_id = false) {
	if ($fk_id) {
	    $this->fk_id = $fk_id;
	    $this->info['fk_id'] = $fk_id;
	}
	if (!$this->fk_table or !$this->fk_id or !$this->fk_account)
	    return false;
	global $TSunic;

	// create new key, if not exists
	if (!$this->getInfo('key')) $this->create();

	// get User object to save for
	$User = $TSunic->get('$usersystem$User', $this->fk_account);
	if (!$User) return false;

	// update database
	$enckey = $User->encrypt($this->getInfo('key'));
	$sql_set = "
	    fk_account = '".$this->fk_account."',
	    fk_account_origin = '".$this->getInfo('fk_account_origin')."',
	    can_write = '".$this->getInfo('can_write')."',
	    _key_ = '".$enckey."'
	";
	$sql = "INSERT INTO #__keys
	    SET fk_id = '".$this->fk_id."',
		fk_table = '".$this->fk_table."',
		".$sql_set."
	    ON DUPLICATE KEY UPDATE ".$sql_set.";";
	return $TSunic->Db->doInsert($sql);
    }

    /* edit data of key
     * @param int: new fk_account
     * @param bool: can write?
     * +@param string: new fk_table
     * +@param int: new fk_id
     * +@param bool: delete old key?
     *
     * @return bool
     */
    public function edit ($new_account, $can_write, $new_table = 0, $new_id = 0, $deleteOld = true) {
	global $TSunic;
	$this->getInfo(true);
	if (empty($new_account)) $new_account = $this->fk_account;
	if (empty($new_table)) $new_table = $this->fk_table;
	if (empty($new_id)) $new_id = $this->fk_id;

	// save old values
	$old_table = $this->fk_table;
	$old_id = $this->fk_id;
	$old_account = $this->fk_account;

	// update key if saving for other user
	if ($new_account != $TSunic->Usr->getInfo('id')) {
	    // push to other user
	    $this->info['key'] = $this->gen_key();
	}
	$this->fk_table = $new_table;
	$this->fk_id = $new_id;
	$this->fk_account = $new_account;
	$this->info['can_write'] = $can_write;

	// save new key
	$this->save();

	// delete old one
	if ($deleteOld) {

	    // reset old values
	    $this->fk_table = $old_table;
	    $this->fk_id = $old_id;
	    $this->fk_account = $old_account;
	    $this->info = array();

	    // delete
	    $this->delete();

	    // set new values again
	    $this->fk_table = $new_table;
	    $this->fk_id = $new_id;
	    $this->fk_account = $new_account;
	    $this->info = array();
	}

	return true;
    }

    /* delete key
     *
     * @return bool
     */
    public function delete () {
	global $TSunic;

	// delete in database
	$sql = "DELETE FROM #__keys
	    WHERE fk_table = '".$this->fk_table."'
		AND fk_id = '".$this->fk_id."'
		AND fk_account = '".$this->fk_account."';";
	return $TSunic->Db->doDelete($sql);
    }

    /* is valid key?
     *
     * @return bool
     */
    public function isValid () {

	// try to get key
	$key = $this->getInfo('key');

	return (empty($key)) ? false : true;
    }
}
?>
