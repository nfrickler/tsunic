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

    /* information about key
     * array
     */
    protected $info;

    /* constructor
     * @param string: name of table
     * @param int: id of entry
     */
    public function __construct ($fk_table, $fk_id) {

	// save
	$this->fk_table = $fk_table;
	$this->fk_id = $fk_id;
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
	if (!$this->fk_table) return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT *
	    FROM #__keys
	    WHERE fk_table = '$this->fk_table'
		AND fk_id = '$this->fk_id'
		AND fk_account = '".$TSunic->Usr->getInfo('id')."';";
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

	// get string
	$string = $this->gen_key();

	// create tmp info
	$this->info = array(
	    'fk_table' => $this->fk_table,
	    'fk_id' => 0,
	    'fk_account' => $TSunic->Usr->getInfo('id'),
	    'fk_account_origin' => $TSunic->Usr->getInfo('id'),
	    'can_write' => 1,
	    'key' => $string
	);

	return true;
    }

    /* save new key in database
     * +@param int: fk_id
     *
     * @return bool
     */
    public function save ($fk_id = false) {
	if (empty($this->info)) return false;
	global $TSunic;
	if ($fk_id) $this->info['fk_id'] = $fk_id;

	// get User object to save for
	$User = $TSunic->get('$usersystem$User', $this->getInfo('fk_account'));
	if (!$User) return false;

	// update database
	$key = $User->encrypt($this->getInfo('key'));
	$sql_set = "
	    fk_account = '".$this->getInfo('fk_account')."',
	    fk_account_origin = '".$this->getInfo('fk_account_origin')."',
	    can_write = '".$this->getInfo('can_write')."',
	    _key_ = '$key'
	";
	$sql = "INSERT INTO #__keys
	    SET fk_id = '".$this->getInfo('fk_id')."',
		fk_table = '".$this->getInfo('fk_table')."',
		".$sql_set."
	    ON DUPLICATE KEY UPDATE ".$sql_set.";";
	return $TSunic->Db->doInsert($sql);
    }

    /* edit data of key
     * @param int: new fk_account
     * @param bool: can write?
     * @param bool: is private key?
     *
     * @return bool
     */
    public function edit ($fk_account, $can_write) {
	global $TSunic;
	$this->getInfo();

	// update
	if ($fk_account != $TSunic->Usr->getInfo('id')) {
	    // push to other user
	    $this->info['key'] = $this->gen_key();
	}
	$this->info['fk_account'] = $fk_account;
	$this->info['can_write'] = $can_write;

	// save new key
	$this->saveKey();

	return true;
    }

    /* delete key
     *
     * @return bool
     */
    public function delete () {
	global $TSunic;
	$this->info = array();

	// delete in database
	$sql = "DELETE FROM #__keys
	    WHERE fk_table = '".$this->fk_table."'
		AND fk_id = '".$this->fk_id."'
		AND fk_account = '".$this->fk_account."';";
	return $TSunic->Db->doDelete($sql);
    }
}
?>
