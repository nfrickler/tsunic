<!-- | CLASS object -->
<?php
/** Abstract base object class
 *
 * This is the base class for a lot of child objects. It offers a kind of a
 * object oriented database and synchronizes data with database.
 */
class $$$Object {

    /** Name of table, where objects of this class are saved
     * @var string $table
     */
    protected $table;

    /** object ID
     * @var int $id
     */
    protected $id;

    /** Array of Key objects of this object
     * @var array $_keys
     */
    protected $_keys = array();

    /** Temporary cache for keytypes in database (is value encrypted or not)
     * @var array $keytypes
     */
    protected $keytypes;

    /** Information about object
     * @var array $info
     */
    protected $info = array();

    /** Temporary information about object
     * @var array $info_tmp
     */
    protected $info_tmp = array();

    /** Constructor
     *
     * @param int $id
     *	Object ID
     */
    public function __construct ($id = 0) {
	global $TSunic;

	// save input
	$this->id = ($this->_validate($id, 'int')) ? $id : 0;

	// log
	$TSunic->Log->log(7,
	    get_class($this).'::__construct: id='.$this->id
	);

	return;
    }

    /** Get information about object
     *
     * @param string|bool $name
     *	Name of info (true will return all information)
     * @param bool $update
     *	Force update of object infos?
     * @param bool $dbonly
     *	Get info from database only (not temporary)?
     *
     * @return mix
     */
    public function getInfo ($name = true, $update = false, $dbonly = false) {

	// update?
	if ($update) $this->_loadInfo();

	// is in info_tmp?
	if (!$dbonly and $this->info_tmp and isset($this->info_tmp[$name]))
	    return $this->info_tmp[$name];

	// onload data
	if (empty($this->info)) $this->_loadInfo();

	// is in info?
	if ($name === true) return $this->info;
	if ($this->info and isset($this->info[$name]))
	    return $this->info[$name];

	return $this->getDefault($name);
    }

    /** Get default value for specific field
     *
     * Here you can define default values of child classes
     *
     * @param string $name
     *	Name of information
     *
     * @return mix
     */
    public function getDefault ($name) {
	return NULL;
    }

    /** Load information about object from database
     *
     * @return bool
     */
    protected function _loadInfo () {
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

    /** Encrypt data to save in database
     *
     * Only those values will be encrypted, where the row in database starts and
     * ends with and underline
     *
     * @param array $data
     *	Data to be encrypted
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

    /** Create new object
     *
     * @param array $data
     *	Data of new object
     *
     * @return bool
     */
    protected function _create ($data) {

	// set date of creation
	$data['dateOfCreation'] = 'NOW()';
	$this->setMulti($data, true);

	return $this->id;
    }

    /** Set value for this object
     *
     * @param string $name
     *	Name of value
     * @param mix $value
     *	New value
     * @param bool $save
     *	Save all new data in database?
     *
     * @return bool
     */
    public function set ($name, $value, $save = false) {
	if (!$this->isValidInfo($name, $value)) return false;
	$this->info_tmp[$name] = $value;
	return ($save) ? $this->save() : true;
    }

    /** Checks wether a value of this object is valid
     *
     * @param string $name
     *	Name of value
     * @param string $value
     *	Value
     *
     * @return bool
     */
    public function isValidInfo ($name, $value) {
	// allow all by default
	return true;
    }

    /** Set multiple values for this object
     *
     * @param array $data
     *	New values
     * +@param bool $save
     *	Save all new data in database?
     *
     * @return bool
     */
    public function setMulti ($data, $save = false) {
	if (!is_array($data)) return false;

	foreach ($data as $index => $value) {
	    $this->set($index, $value);
	}

	return ($save) ? $this->save() : true;
    }

    /** Resave all data (e.g. with new key)
     *
     * @return bool
     */
    public function resave () {
	return $this->save(true);
    }

    /** Edit object
     *
     * @param array $data
     *	New data
     * @param bool $save_empty
     *	Save empty strings
     *
     * @return bool
     */
    protected function _edit ($data, $save_empty = false) {

	// skip empty values?
	if (!$save_empty) {
	    $new = array();
	    foreach ($data as $index => $value) {
		if (!empty($value)) $new[$index] = $value;
	    }
	    $data = $new;
	}

	return $this->setMulti($data, true);
    }

    /** Save temporary data in database
     *
     * @param bool $force
     *	Force resave of all values?
     *
     * @return bool
     */
    public function save ($force = false) {
	if (!$this->table or !$this->editable()) return false;
	global $TSunic;

	// get data to update
	$data = array();
	if ($force) $data = $this->getInfo(true);
	foreach ($this->info_tmp as $index => $value) {

	    // no change?
	    if (!$force and isset($this->info[$index]) and
		$this->info[$index] === $value
	    ) continue;

	    $data[$index] = $value;
	}

	// any data to update?
	if (empty($data)) return true;

	// encrypt
	$data = $this->_data2db($data);
	if (!$data) return false;

	// create SET statements for sql query
	foreach ($data as $index => $value) {

	    // if password is ********, do not update it
	    if ($index == "password" and $value == "**********") {
		unset($data[$index]);
		continue;
	    }

	    // save NOW as operation not as string
	    // NOTE: === required, since == would return true when $value === 0
	    if ($value === 'NOW()') {
		$data[$index] = "$index = NOW()";
		continue;
	    }

	    $data[$index] = "$index = '$value'";
	}

	// return if no data to update
	if (empty($data)) return true;

	// update database
	if ($this->id) {

	    // update
	    $sql = "UPDATE $this->table
		SET ".implode(",",$data)."
		WHERE id = '$this->id';";
	    if (!$TSunic->Db->doUpdate($sql)) return false;

	} else {

	    // insert
	    $sql = "INSERT INTO $this->table SET ".implode(",",$data).";";
	    $this->id = $TSunic->Db->doInsert($sql);
	}

	// update info
	$this->info_tmp = array();
	$this->_loadInfo();

	// update keys
	foreach ($this->getKeys() as $index => $Value) {
	    $Value->save($this->id);
	}

	// udpate shareWith information
	$this->shareWith();

	return true;
    }

    /** Delete object
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
	foreach ($this->getKeys() as $index => $Value) {
	    $Value->delete();
	}

	return true;
    }

    /** Check, if this object is valid (=exists in database)
     *
     * @return bool
     */
    public function isValid () {

	// try to get some information from database
	$info = $this->getInfo(true, false, true);

	// if anything in database found, it is valid
	if (is_array($info) and count($info) > 0) return true;

	return false;
    }

    /** Check, if value has correct type
     *
     * @param mix $value
     *	Value
     * @param string $type
     *	Requested type of value
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

    /** Is unique value? (either not in table or belongs to this object)
     *
     * @param string $table
     *	Name of table
     * @param string $column
     *	Column in table
     * @param string $value
     *	Value
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

    /** Does other object with given id exist?
     *
     * @param string $table
     *	Name of table
     * @param int $id
     *	ID of object
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

    /** Make copy of this object
     *
     * @return int
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

    /* *********************** key handling *********************** */

    /** Preset keys for this object
     *
     * @param array $keys
     *	Array of Key objects
     *
     * @return bool
     */
    public function setKeys ($keys) {

	// set table and id
	foreach ($keys as $index => $Value) {
	    $Value->edit(0, 1, $this->table, $this->id, false);
	}

	$this->_keys = $keys;
	return true;
    }

    /** Get all Key objects for this object
     *
     * @return array
     */
    public function getKeys () {
	if ($this->_keys) return $this->_keys;
	if (!$this->id) return array();
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

    /** Load Key
     *
     * @param int $fk_account
     *	fk_account of key to return
     *
     * @return Key
     */
    protected function _getKey ($fk_account = 0) {
	global $TSunic;
	$fk_account_parameter = $fk_account;
	if (!$fk_account) $fk_account = $TSunic->Usr->getInfo('id');

	// load keys
	if (empty($this->_keys)) $this->getKeys();

	// if still empty, create new empty key
	if (empty($this->_keys)) {
	    $this->_keys[$fk_account] = $TSunic->get('$$$Key', array($this->table, $this->id, $fk_account));
	}

	// if key exists, return
	if (isset($this->_keys[$fk_account]))
	    return $this->_keys[$fk_account];

	// if no valid key found and no $fk_account parameter, try to find
	// guest-key
	if ((!isset($this->_keys[$fk_account]) or
	    !$this->_keys[$fk_account]->isValid()) and
	    !$fk_account_parameter and
	    $fk_account == $TSunic->Usr->getInfo('id') and
	    isset($this->_keys[$TSunic->Usr->getIdGuest()])
	) {
	    return $this->_keys[$TSunic->Usr->getIdGuest()];
	}

	// if no valid key, but another key is valid, return copy of this key
	if (!isset($this->_keys[$fk_account])) {

	    // is any valid key?
	    foreach ($this->_keys as $index => $Value) {
		if ($Value->isValid()) {
		    return $Value;
		}
	    }
	}

	// if still nothing to return, create new empty key
	if (!isset($this->_keys[$fk_account])) {
	    $this->_keys[$fk_account] = $TSunic->get(
		'$$$Key', array($this->table, $this->id, $fk_account)
	    );
	    $this->_keys[$fk_account]->create();
	    $this->_keys[$fk_account]->save();
	}

	return (isset($this->_keys[$fk_account]))
	    ? $this->_keys[$fk_account] : NULL;
    }

    /** Save Key
     * @param int $fk_account
     *	fk_account of Key
     *
     * @return bool
     */
    protected function _saveKey ($fk_account = 0) {
	return $this->_getKey($fk_account)->save($this->id);
    }

    /** Delete Key
     *
     * @param int $fk_account
     *	fk_account of Key
     *
     * @return bool
     */
    protected function _deleteKey ($fk_account = 0) {

	// get key
	$Key = $this->_getKey($fk_account);

	// delete key
	if (!$fk_account or $Key->getInfo('fk_account') == $fk_account) {

	    // delete key from _keys-array
	    $new_keys = array();
	    foreach ($this->_keys as $index => $Value) {
		if ($index != $Key->getInfo('fk_account'))
		    $new_keys[$index] = $Value;
	    }
	    $this->_keys = $new_keys;

	    // delete Key object itself
	    return $Key->delete();
	}

	return true;
    }

    /* *********************** shared objects ********************* */

    /** Get sharedWith information of this object
     *
     * @return array
     */
    public function getSharedWith () {

	// get all Key objects
	$keys = $this->getKeys();

	// get sharedWith information
	$shared = array();
	foreach ($keys as $index => $Value) {
	    $shared[$Value->getInfo('fk_account')] =
		$Value->getInfo('can_write');
	}

	return $shared;
    }

    /** Give someone access to this object
     *
     * @param array|int $access
     *	List of users with access (array('id' => 'writable?'))
     *
     * @return bool
     */
    public function shareWith ($access = false) {
	global $TSunic;
	if (!$this->editable()) return false;
	if (empty($access)) {
	    $access = $this->getSharedWith();
	} else {
	    // add myself to access list
	    $access[$TSunic->Usr->getInfo('id')] = 1;
	}
	if (empty($access)) return true;
	$TSunic->Log->log(7, "Object::shareWith: sharing $this->table ".
	    "($this->id) ".count($access));

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
	    $Key->getInfo('key');

	    // copy this key
	    if ($Key->getInfo('fk_account') != $index) {
		$Key = $Key->getCopy();
		if ($Key) $this->_keys[$index] = $Key;
	    }

	    // set writable
	    if ($Key)
		$Key->edit($index, $value, $this->table, $this->id, false);
	}

	return true;
    }

    /** Push this object to other user
     *
     * @param int $fk_account
     *	Id of other user
     *
     * @return bool
     */
    public function pushTo ($fk_account) {
	if (!$this->editable()) return false;
	global $TSunic;
	$TSunic->Log->log(6, "Object::pushTo: pushing $this->table ".
	    "($this->id) to $fk_account");

	// get User object
	$User = $TSunic->get('$usersystem$User', $fk_account);
	if (!$User->isValid()) return false;

	// share with other user
	$this->shareWith(array($fk_account => 1));

	// delete my own key
	$this->_deleteKey();

	// change key
	$Key = $this->_getKey($fk_account);
	$Key->create();
	$Key->save();

	// update fk_account
	$this->set('fk_account', $User->getInfo('id'));

	// resave data
	$this->resave();

	return true;
    }

    /** Push copy of this object to other user
     *
     * @param int $fk_account
     *	Id of other user
     *
     * @return bool
     */
    public function copyTo ($fk_account) {
	if (!$this->editable()) return false;

	// make copy
	$copyid = $this->copy();

	// push copy to other user
	$Obj = $TSunic->get(get_class(), $copyid);
	return $Obj->pushTo($fk_account);
    }

    /** Is object editable by user?
     *
     * @return object
     */
    public function editable () {
	return (!$this->_getKey()->isValid() or
	    $this->_getKey()->getInfo('can_write')
	) ? true : false*;
    }
}
?>
