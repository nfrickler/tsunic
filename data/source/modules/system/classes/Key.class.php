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

    /* fk_account
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

	// set fk_account
	if (!$fk_account) $fk_account = $TSunic->Usr->getInfo('id');

	// save
	$this->fk_table = $fk_table;
	$this->fk_id = $fk_id;
	$this->fk_account = $fk_account;
    }

    /* get information about key
     * +@param string: name of info
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
	if (!$this->fk_table or !$this->fk_account) return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT *
	    FROM #__keys
	    WHERE fk_table = '$this->fk_table'
		AND fk_id = '$this->fk_id'
		AND fk_account = '$this->fk_account';";
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

	$data = $TSunic->Usr->encrypt($data, $this->getInfo('key'));
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

    /* get key
     *
     * @return string
     */
    public function create () {
	global $TSunic;

	// get string
	$string = '';
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	for ($i = 0; $i < 30; $i++) {
	    $string .= $characters[mt_rand(0, (strlen($characters)-1))];
	}

	// create tmp info
	$this->info = array(
	    'fk_table' => $this->fk_table,
	    'fk_id' => 0,
	    'fk_account' => $TSunic->Usr->getInfo('id'),
	    'readwrite' => 0,
	    'key' => $string
	);

	return true;
    }

    /* save new key in database
     * @param int: fk_id
     *
     * @return bool
     */
    public function save ($fk_id) {
	if (empty($this->info)) return false;
	global $TSunic;
	$this->info['fk_id'] = $fk_id;

	// update database
	$key = $TSunic->Usr->encrypt($this->getInfo('key'));
	$sql = "INSERT INTO #__keys
	    SET fk_table = '".$this->getInfo('fk_table')."',
		fk_id = '".$this->getInfo('fk_id')."',
		fk_account = '".$this->getInfo('fk_account')."',
		readwrite = '".$this->getInfo('readwrite')."',
		_key_ = '$key'
	    ON DUPLICATE KEY UPDATE _key_ = '$key';";
	return $TSunic->Db->doInsert($sql);
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
