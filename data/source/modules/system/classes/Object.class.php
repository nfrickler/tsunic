<!-- | CLASS object (meta class) -->
<?php
class $$$Object {

    /* tablename in database
     * string
     */
    protected $table;

    /* object ID
     * int
     */
    protected $id;

    /* array of Key objects of this object
     * array
     */
    protected $_keys = array();

    /* Key object (if set, overwrites _keys)
     * object
     */
    protected $_Key;

    /* temporary cache for keytypes in database (0: - 1: encrypted)
     * array
     */
    protected $keytypes;

    /* information about object
     * array
     */
    protected $info;

    /* is $this->info really loaded from database (may be preset otherwise)
     * bool
     */
    protected $info_isloaded = false;

    /* constructor
     * +@param int: Object ID
     */
    public function __construct ($id = 0) {
	global $TSunic;

	// save input
	$this->id = ($this->_validate($id, 'int')) ? $id : 0;

	// log
	$TSunic->Log->log(7, get_class($this).'::__construct: id='.$this->id);

	return;
    }

    /* preset information array of object (may increase performance); will fail
     * if already loaded from database
     * @param array: preset for $this->info
     *
     * @return bool
     */
    public function presetInfo ($preset) {
	if (!$this->info_isloaded and is_array($preset)) {
	    $this->info = $preset;
	    return true;
	}
	return false;
    }

    /* get information about object
     * +@param string/bool: name of info (true will return $this->info)
     * +@param bool: force update of object infos?
     *
     * @return mix
     */
    public function getInfo ($name = true, $update = false) {

	// onload data
	if ($update or empty($this->info)) $this->_loadInfo();

	// return requested info
	if ($name === true) return $this->info;
	if (isset($this->info[$name])) return $this->info[$name];

	// nothing found (load if not loaded yet)
	if (!$this->info_isloaded) return $this->getInfo($name, true);

	return NULL;
    }

    /* set key for this object
     * @param object: Key object
     *
     * @return bool
     */
    public function setKey ($Key) {

	// set table and id
	$Key->edit(0, 1, $this->table, $this->id, false);

	$this->_Key = $Key;
	return true;
    }

    /* get all Key objects for this object
     *
     * @return array
     */
    public function getKeys () {
	global $TSunic;

	// query database
	$sql = "SELECT fk_account
	    FROM #__$system$keys
	    WHERE fk_table = '$this->table'
		AND fk_id = '$this->id'
	";
	$result = $TSunic->Db->doSelect($sql);

	// get Key objects
	$this->_keys = array();
	foreach ($result as $index => $values) {
	    $this->_keys[$values['fk_account']] = $TSunic->get('$$$Key', array(
		$this->table, $this->id, $values['fk_account'])
	    );
	}

	return $this->_keys;
    }

    /* load Key
     * +@param int: fk_account of key to return
     *
     * @return Object
     */
    protected function _getKey ($fk_account = 0) {
	global $TSunic;
	$empty_fk_account = ($fk_account) ? false : true;
	if (!$fk_account) $fk_account = $TSunic->Usr->getInfo('id');

	// if _Key is set, use this one!
	if ($this->_Key) return $this->_Key;

	// load keys
	if (empty($this->_keys)) $this->getKeys();

	// if no valid key found and no $fk_account parameter, try to find
	// guest-key
	if ((!isset($this->_keys[$fk_account]) or
	    !$this->_keys[$fk_account]->isValid()) and
	    $empty_fk_account and
	    $fk_account == $TSunic->Usr->getInfo('id') and
	    isset($this->_keys[$TSunic->Usr->getIdGuest()])
	) {
	    return $this->_keys[$TSunic->Usr->getIdGuest()];
	}

	// if still empty, create new empty key
	if (empty($this->_keys)) {
	    $this->_keys[$fk_account] = $TSunic->get('$$$Key', array($this->table, $this->id, $fk_account));
	}

	// if no valid key, but another key is valid, return copy of this key
	if (!isset($this->_keys[$fk_account])) {

	    // is any valid key?
	    foreach ($this->_keys as $index => $Value) {
		$Copy = $Value->getCopy();
		if ($Copy) {
		    $Copy->edit($fk_account, $Value->getInfo('can_write'), 0, 0, false);
		    $this->_keys[$fk_account] = $Copy;
		    break;
		}
	    }
	}

	return (isset($this->_keys[$fk_account]))
	    ? $this->_keys[$fk_account] : NULL;
    }

    /* save Key
     * +@param int: fk_account of key
     *
     * @return bool
     */
    protected function _saveKey ($fk_account = 0) {
	return $this->_getKey($fk_account)->save($this->id);
    }

    /* delete Key
     * +@param int: fk_account of key
     *
     * @return bool
     */
    protected function _deleteKey ($fk_account = 0) {
	return $this->_getKey($fk_account)->delete();
    }

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	$this->info_isloaded = true;
	if (!$this->id or !$this->table) return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT * FROM $this->table WHERE id = '$this->id';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;

	// decrypt
	$this->info = array();
	foreach ($result[0] as $index => $value) {

	    // encrypted
	    if (substr($index,0,1) == "_" and substr($index,-1) == "_") {
		$index = substr($index,1);
		$index = substr($index,0,(strlen($index)-1));
		$this->keytypes[$index] = 1;
		$this->info[$index] = $this->_getKey()->decrypt($value);

	    // not encrypted
	    } else {
		$this->keytypes[$index] = 0;
		$this->info[$index] = $value;
	    }
	}

	return true;
    }

    /* encrypt data to save in database
     * @param array: new data
     *
     * @return data to save
     */
    protected function _data2db ($data) {
	global $TSunic;

	// get keytypes
	if (!$this->keytypes) {
	    $columns = $TSunic->Db->getColumns($this->table);

	    foreach ($columns as $index => $value) {
		if (substr($value,0,1) == "_" and substr($value,-1) == "_") {
		    $value = substr($value,1);
		    $value = substr($value,0,(strlen($value)-1));
		    $this->keytypes[$value] = 1;
		} else {
		    $this->keytypes[$value] = 0;
		}
	    }
	}

	// encrypt
	foreach ($data as $index => $value) {

	    // exists?
	    if (!isset($this->keytypes[$index])) {
		$TSunic->Log->log(
		    3, "Object: key ".$this->table.".".$index." doesn't exist!"
		);
		unset($data[$index]);
		continue;
	    }

	    // encrypt?
	    if ($this->keytypes[$index]) {
		unset($data[$index]);
		$data["_".$index."_"] = $this->_getKey(
		    $TSunic->Usr->getInfo('id'))->encrypt($value);
	    }
	}

	return $data;
    }

    /* create new object
     * @param array: new data
     *
     * @return bool
     */
    protected function _create ($data) {
	if (!is_array($data)) return false;
	global $TSunic;

	// encrypt
	$data = $this->_data2db($data);

	// save in database
	foreach ($data as $index => $value) {
	    if ($value and $value == 'NOW()') {
		$data[$index] = "$index = NOW()";
		continue;
	    }
	    $data[$index] = "$index = '$value'";
	}
	$sql = "INSERT INTO $this->table SET ".implode(",",$data).";";
	$this->id = $TSunic->Db->doInsert($sql);

	// update object infos
	$this->_loadInfo();
	$this->_saveKey($TSunic->Usr->getInfo('id'));

	return ($this->id) ? $this->id : false;
    }

    /* resave all data (e.g. with new key)
     *
     * @return bool
     */
    public function resave () {
	return $this->_edit($this->getInfo(true), true);
    }

    /* edit object
     * @param array: new data
     * @param bool: save empty strings
     *
     * @return bool
     */
    protected function _edit ($data, $save_empty = false) {
	if (!$this->table) return false;
	if (!$data) return true;
	global $TSunic;

	// encrypt
	$data = $this->_data2db($data);
	if (!$data) return false;

	// update database
	foreach ($data as $index => $value) {
	    if (!$save_empty and !$value or
		($index == "password" and $value == "**********")
	    ) {
		unset($data[$index]);
		continue;
	    }

	    if ($value == 'NOW()') {
		$data[$index] = "$index = NOW()";
		continue;
	    }
	    $data[$index] = "$index = '$value'";
	}
	if ($data) {
	    $sql = "UPDATE $this->table
		SET ".implode(",",$data)."
		WHERE id = '$this->id';";
	    if (!$TSunic->Db->doUpdate($sql)) return false;
	}

	// update infos
	$this->_loadInfo();
	$this->_saveKey($TSunic->Usr->getInfo('id'));

	return true;
    }

    /* delete object
     *
     * @return bool
     */
    protected function _delete () {
	global $TSunic;

	// delete object in database
	$sql = "DELETE FROM $this->table WHERE id = '$this->id';";
	$result = $TSunic->Db->doDelete($sql);
	if (!$result) return false;

	// invalidate object
	$this->id = 0;
	$this->_loadInfo();
	$this->_deleteKey();

	return true;
    }

    /* check, if this object is valid
     *
     * @return bool
     */
    public function isValid () {

	// object is considered valid, if it has an ID and at least
	// one more information in $this->info
	if ($this->getInfo() and count($this->getInfo() > 1))
	    return true;

	return false;
    }

    /* check, if value has correct type
     * @param mix: value
     * @param string: requested type of value
     *
     * @return bool
     */
    protected function _validate ($value, $type) {

	// validate type
	switch ($type) {
	    case 'string':
		return $$$Validator::isString($value);
	    case 'extString':
		return $$$Validator::isExtString($value);
	    case 'text':
		return $$$Validator::isText($value);
	    case 'html':
		return $$$Validator::isHtml($value);
	    case 'filename':
		return $$$Validator::isFilename($value);
	    case 'int':
		return $$$Validator::isInt($value);
	    case 'double':
		return $$$Validator::isDouble($value);
	    case 'uri':
		return $$$Validator::isUri($value);
	    case 'url':
		return $$$Validator::isUrl($value);
	    case 'email':
		return $$$Validator::isEMail($value);
	    case 'password':
		return $$$Validator::isPassword($value);
	}

	return false;
    }

    /* is unique value? (either not in table or belongs to this object)
     * @param string: name of table
     * @param string: column in table
     * @param string: value
     *
     * @return bool
     */
    protected function _isUnique ($table, $column, $value) {
	global $TSunic;
	$sql = "SELECT id
		FROM $table
		WHERE $column = '$value'
		    AND NOT id = '$this->id'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return false;
	return ($result) ? false : true;
    }

    /* does other object with ID exist?
     * @param string: name of table
     * @param int: ID of object
     *
     * @return bool
     */
    protected function _isObject ($table, $id) {
	if (!$this->_validate($id, 'int')) return false;
	global $TSunic;
	$sql = "SELECT id
		FROM $table
		WHERE id = '$id'
	;";
	$result = $TSunic->Db->doSelect($sql);
	return ($result) ? true : false;
    }

    /* make copy of this object
     *
     * @return int (id of copy)
     */
    public function copy () {
	if (!$this->id) return 0;

	// save current id
	$myid = $this->id;

	// get current data
	$data = $this->getInfo(true);

	// delete some info
	unset($data['id']);

	// create new object with the same data
	$copyid = $this->_create($data);

	// reset id again
	$this->id = $myid;
	$this->_loadInfo();

	return $copyid;
    }

    /* *********************** shared objects ********************* */

    /* give someone access to this object
     * @param array/int: list of users with access (array('id' => 'writable?'))
     *
     * @return bool
     */
    public function shareWith ($access) {
	global $TSunic;

	// add myself to access list
	$access[$TSunic->Usr->getInfo('id')] = 1;

	// remove all keys without access
	foreach ($this->getKeys() as $index => $Value) {
	    $fk_account = $Value->getInfo('fk_account');
	    $ok = 0;
	    foreach ($access as $in => $val) {
		if ($in == $fk_account) {
		    $ok = 1;
		    break;
		}
	    }

	    // delete key if not ok
	    if (!$ok) {
		$this->_deleteKey($fk_account);
	    }
	}

	// add new keys and set writable
	foreach ($access as $index => $value) {

	    // get Key object
	    $Key = $this->_getKey($index);

	    // set writable
	    $Key->edit($index, $value, 0, 0, false);
	}

	return true;
    }

    /* push this object to other user
     * @param int: id of other user
     *
     * @return bool
     */
    public function pushTo ($fk_account) {
	global $TSunic;

	// get User object
	$User = $TSunic->get('$usersystem$User', $fk_account);
	if (!$User->isValid()) return false;

	// get current key
	$key = $this->_getKey();

	// load all data
	$this->getInfo();

	// update key
	$key->edit($User->getInfo('id'), 1);

	// create new key
	$key->create();
	$key->save();

	// update fk_account
	$this->info['fk_account'] = $User->getInfo('id');

	// resave data with new key
	$this->resave();

	return true;
    }

    /* push copy of this object to other user
     * @param int: id of other user
     *
     * @return bool
     */
    public function copyTo ($fk_account) {

	// make copy
	$copyid = $this->copy();

	// push copy to other user
	$Obj = $TSunic->get(get_class(), $copyid);
	return $Obj->pushTo($fk_account);
    }

    /* is object editable by user?
     *
     * @return object
     */
    public function editable () {
	return ($this->_getKey()->getInfo('can_write')) ? true : false;
    }
}
?>
