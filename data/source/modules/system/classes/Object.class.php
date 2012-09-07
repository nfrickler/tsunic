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

    /* temporary cache for keytypes in database (0: - 1: encrypted)
     * array
     */
    protected $keytypes;

    /* information about object
     * array
     */
    protected $info;

    /* constructor
     * +@param int: Object ID
     */
    public function __construct ($id = 0) {

	// save input
	$this->id = ($this->_validate($id, 'int')) ? $id : 0;

	return;
    }

    /* get information about object
     * +@param string/bool: name of info (true will return $this->info)
     * +@param bool: force update of object infos?
     *
     * @return mix
     */
    public function getInfo ($name = true, $update = false) {
	global $TSunic;

	// check, if is object ID
	if (!$this->id) return false;

	// onload data
	if ($update or empty($this->info)) $this->_loadInfo();

	// return requested info
	if ($name === true) return $this->info;
	if (isset($this->info[$name])) return $this->info[$name];

	return NULL;
    }

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!$this->id or !$this->table) return false;
	global $TSunic;

	// get data from database
	$sql = "SELECT * FROM $this->table WHERE id = '$this->id';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// decrypt
	$this->info = array();
	foreach ($result[0] as $index => $value) {

	    // encrypted
	    if (substr($index,0,1) == "_" and substr($index,-1) == "_") {
		$index = substr($index,1);
		$index = substr($index,0,(strlen($index)-1));
		$this->keytypes[$index] = 1;
		$this->info[$index] = $TSunic->Usr->decrypt($value);

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
		unset($data[$index]);
		continue;
	    }

	    // encrypt?
	    if ($this->keytypes[$index]) {
		unset($data[$index]);
		$data["_".$index."_"] = $TSunic->Usr->encrypt($value);
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
	if (!is_array($data) or $this->id) return false;
	global $TSunic;

	// encrypt
	$data = $this->_data2db($data);

	// save in database
	foreach ($data as $index => $value) {
	    $data[$index] = "$index = '$value'";
	}
	$sql = "INSERT INTO $this->table SET ".implode(",",$data).";";
	$this->id = $TSunic->Db->doInsert($sql);

	// update object infos
	$this->_loadInfo();

	return ($this->id) ? true : false;
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

	    $data[$index] = "$index = '$value'";
	}
	$sql = "UPDATE $this->table
		SET ".implode(",",$data)."
		WHERE id = '$this->id';";
	if (!$TSunic->Db->doUpdate($sql)) return false;

	// update infos
	$this->_loadInfo();

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
	include_once '$$$Validator.class.php';

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
	return ($this->_validate($id, 'int'))
	    ? !$this->_isUnique($table, 'id', $id) : false;
    }
}
?>
