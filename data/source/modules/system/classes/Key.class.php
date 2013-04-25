<!-- | CLASS Key -->
<?php
/** Handling Encryption keys for Objects in database
 *
 * This class is responsible for the key managemant for all objects.
 * It holds the key for a certain object and creates/manages/stores the key in
 * the database
 *
 */
class $$$Key {

    /** Information about key
     * @var array $info
     */
    protected $info = array();

    /** Temporary information about key
     * @var array $info_tmp
     */
    protected $info_tmp = array();

    /* Constructor
     *
     * @param string $fk_table
     *	Name of table
     * @param int $fk_id
     *	Id of object
     * @param int $fk_account
     *	fk_account
     */
    public function __construct ($fk_table, $fk_id, $fk_account = 0) {
	global $TSunic;

	// save
	$this->info_tmp['fk_table'] = $fk_table;
	$this->info_tmp['fk_id'] = $fk_id;
	$this->info_tmp['fk_account'] = ($fk_account)
	    ? $fk_account : $TSunic->Usr->getInfo('id');
    }

    /** Get information about key
     *
     * @param string $name
     *	Name of info
     *
     * @return mix
     */
    public function getInfo ($name) {
	global $TSunic;

	// onload data
	if (empty($this->info)) $this->_loadInfo();

	// return requested info
	if ($this->info and isset($this->info[$name]))
	    return $this->info[$name];
	if ($this->info_tmp and isset($this->info_tmp[$name]))
	    return $this->info_tmp[$name];

	return NULL;
    }

    /** Load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!isset($this->info_tmp['fk_table'], $this->info_tmp['fk_id'],
	    $this->info_tmp['fk_account']) or
	    !$this->info_tmp['fk_table'] or !$this->info_tmp['fk_id'] or
	    !$this->info_tmp['fk_account']
	) return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT *
	    FROM #__$system$keys
	    WHERE fk_table = '".$this->info_tmp['fk_table']."'
		AND fk_id = '".$this->info_tmp['fk_id']."'
		AND fk_account = '".$this->info_tmp['fk_account']."'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;
	$this->info = $result[0];

	// decrypt key
	$this->info['key'] = $TSunic->Usr->decrypt($this->info['_key_']);
	unset($this->info['_key_']);

	$this->info_tmp = $this->info;
	return true;
    }

    /** Encrypt data using this key
     *
     * @param string $data
     *	Data to be encrypted
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

    /** Decrypt data using this key
     *
     * @param string $data
     *	Data to be decrypted
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

    /** Get new random key phrase
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

    /** Create new key
     *
     * @return string
     */
    public function create () {
	global $TSunic;

	// create tmp info
	$this->info_tmp['fk_account_origin'] = $TSunic->Usr->getInfo('id');
	$this->info_tmp['can_write'] = 1;
	$this->info_tmp['key'] = $this->gen_key();

	return true;
    }

    /** Save new key in database
     *
     * @param int $fk_id
     *	Id of object this key belongs to
     *
     * @return bool
     */
    public function save ($fk_id = false) {
	global $TSunic;
	if ($fk_id) $this->info_tmp['fk_id'] = $fk_id;
	if (!isset($this->info_tmp['fk_table'], $this->info_tmp['fk_id'],
	    $this->info_tmp['fk_account']) or
	    !$this->info_tmp['fk_table'] or !$this->info_tmp['fk_id'] or
	    !$this->info_tmp['fk_account']
	) return false;

	// create new key, if not exists
	if (!$this->isValid()) {
	    $this->create();
	}

	// get User object to save for
	$User = ($this->info_tmp['fk_account'] == $TSunic->Usr->getInfo('id'))
	    ? $TSunic->Usr
	    : $TSunic->get('$usersystem$User', $this->info_tmp['fk_account'], true);
	if (!$User) return false;

	$this->getInfo('key');
	if (isset($this->info) and count($this->info) == 6 and
	    $this->info_tmp['fk_account'] == $this->info['fk_account'] and
	    $this->info_tmp['fk_table'] == $this->info['fk_table'] and
	    $this->info_tmp['fk_id'] == $this->info['fk_id'] and
	    $this->info_tmp['fk_account_origin'] == $this->info['fk_account_origin'] and
	    $this->info_tmp['can_write'] == $this->info['can_write'] and
	    $this->info_tmp['key'] == $this->info['key']
	) {
	    return true;
	}

	// update database
	$enckey = $User->encrypt($this->info_tmp['key']);
	$sql_set = "
	    fk_table = '".$this->info_tmp['fk_table']."',
	    fk_id = '".$this->info_tmp['fk_id']."',
	    fk_account = '".$this->info_tmp['fk_account']."',
	    fk_account_origin = '".$this->info_tmp['fk_account_origin']."',
	    can_write = '".$this->info_tmp['can_write']."',
	    _key_ = '".$enckey."'
	";
	$sql = "INSERT INTO #__$system$keys
	    SET ".$sql_set."
	    ON DUPLICATE KEY UPDATE ".$sql_set.";";
	$return = $TSunic->Db->doInsert($sql);

	// update info
	$this->info = $this->info_tmp;

	return $return;
    }

    /** Edit data of key
     *
     * @param int $new_account
     *	New fk_account
     * @param bool $can_write
     *	Can write?
     * @param string $new_table
     *	New fk_table
     * @param int $new_id
     *	New fk_id
     * @param bool $deleteOld
     *	Delete old key?
     *
     * @return bool
     */
    public function edit ($new_account, $can_write, $new_table = 0, $new_id = 0, $deleteOld = true) {
	global $TSunic;

	// backup old data
	$this->getInfo('key');
	$old_info = $this->info;

	// set new data
	if ($new_account) $this->info_tmp['fk_account'] = $new_account;
	if ($new_table) $this->info_tmp['fk_table'] = $new_table;
	if ($new_id) $this->info_tmp['fk_id'] = $new_id;
	$this->info_tmp['can_write'] = $can_write;

	// save new data
	$this->save();

	// delete old data?
	if ($deleteOld and (
	    $this->info_tmp['fk_account'] != $old_info['fk_account'] or
	    $this->info_tmp['fk_table'] != $old_info['fk_table'] or
	    $this->info_tmp['fk_id'] != $old_info['fk_id']
	)) {
	    // backup new data
	    $new_info = $this->info_tmp;

	    // reset old data
	    $this->info_tmp = $old_info;
	    $this->info = $old_info;

	    // delete old key
	    $this->delete();

	    // reset new data
	    $this->info_tmp = $new_info;
	    $this->info = $new_info;
	}

	return true;
    }

    /** Delete this key
     *
     * @return bool
     */
    public function delete () {
	if (!isset($this->info_tmp['fk_table'], $this->info_tmp['fk_id'],
	    $this->info_tmp['fk_account']) or
	    !$this->info_tmp['fk_table'] or !$this->info_tmp['fk_id'] or
	    !$this->info_tmp['fk_account']
	) return false;
	global $TSunic;

	// delete in database
	$sql = "DELETE FROM #__$system$keys
	    WHERE fk_table = '".$this->info_tmp['fk_table']."'
		AND fk_id = '".$this->info_tmp['fk_id']."'
		AND fk_account = '".$this->info_tmp['fk_account']."';";
	$return = $TSunic->Db->doDelete($sql);

	// delete info
	$this->info = array();
	$this->info_tmp = array();

	return $return;
    }

    /** Is valid decrypted key?
     *
     * @return bool
     */
    public function isValid () {

	// try to get key
	$key = $this->getInfo('key');

	return (empty($key) or substr($key, 0, 1) == '#') ? false : true;
    }

    /** Get copy of this key
     *
     * @return bool
     */
    public function getCopy () {
	if (!$this->isValid()) return NULL;
	global $TSunic;

	// clone object (not in database!)
	return $TSunic->get('$$$Key', array(
	    $this->info_tmp['fk_table'],
	    $this->info_tmp['fk_id'],
	    $this->info_tmp['fk_account']
	), true);
    }
}
?>
