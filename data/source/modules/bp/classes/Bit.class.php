<!-- | CLASS Bit -->
<?php
class $$$Bit extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = '#__bits';

    /* tablename of Piece object in database
     * string
     */
    protected $table_piece = '#__pieces';

    /* fk_piece
     * int
     */
    protected $fk_piece;

    /* name
     * string
     */
    protected $name;

    /* constructor
     * @param int: foreign key of piece
     * @param string: name of bit
     * @param string: value of bit (to prevent massive sql queries)
     */
    public function __construct ($fk_piece = 0, $name = "", $value = NULL) {

	// save input
	$this->fk_piece = $fk_piece;
	$this->name = $name;

	// init info array
	if (!($value === NULL)) {
	    $this->info = array(
		'name' => $name,
		'value' => $value
	    );
	}

	return;
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

	return NULL;
    }

    /* load Key (this is the one used by fk_piece!)
     *
     * @return Object
     */
    protected function _getKey () {
	global $TSunic;
	if (!$this->_Key) $this->_Key =
	    $TSunic->get('$system$Key', array($this->table_piece, 1));
	return $this->_Key;
    }

    /* save Key
     *
     * @return bool
     */
    protected function _saveKey () {
	return $this->_getKey()->save(1);
    }

    /* delete Key
     *
     * @return bool
     */
    protected function _deleteKey () {
	return true;
    }

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!$this->fk_piece or !$this->name or !$this->table) return false;
	global $TSunic;
	$Key = $this->_getKey();

	// get data from database (by fk_piece and name!)
	$sql = "SELECT *
	    FROM $this->table
	    WHERE fk_piece = '$this->fk_piece'
		AND _name_ = '".$Key->encrypt($this->name)."';";
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
	$Key = $this->_getKey();

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
		WHERE fk_piece = '$this->fk_piece'
		    AND _name_ = '".$Key->encrypt($this->name)."';";
	    if (!$TSunic->Db->doUpdate($sql)) return false;
	}

	// update infos
	$this->_loadInfo();
	$this->_saveKey();

	return true;
    }

    /* delete object
     *
     * @return bool
     */
    protected function _delete () {
	global $TSunic;
	$Key = $this->_getKey();

	// delete object in database
	$sql = "DELETE FROM $this->table
	    WHERE fk_piece = '$this->fk_piece'
		AND _name_ = '".$Key->encrypt($this->name)."'
	;";
	$result = $TSunic->Db->doDelete($sql);
	if (!$result) return false;

	// invalidate object
	$this->id = 0;
	$this->_loadInfo();
	$this->_deleteKey();

	return true;
    }

    /* create new bit
     * @param int: fk_piece
     * @param string: name
     * @param string: value
     *
     * @return bool
     */
    public function create ($fk_piece, $name, $value) {

	// validate input
	if (!$this->isValidPiece($fk_piece)
	    or !$this->isValidName($name)
	    or !$this->isValidValue($value)
	) return false;

	// update database
	global $TSunic;
	$data = array(
	    "fk_piece" => $fk_piece,
	    "name" => $name,
	    "value" => $value
	);
	if (!$this->_create($data)) return false;

	return $this->id;
    }

    /* edit bit
     * @param string: value
     *
     * @return bool
     */
    protected function edit ($value) {
	if (!$this->isValid()) return false;
	global $TSunic;

	// validate input
	if (!$this->isValidValue($value)) return false;

	// update database
	global $TSunic;
	$data = array(
	    "value" => $value
	);
	if (!$this->_edit($data)) return false;

	return true;
    }

    /* check, if fk_piece is valid
     * @param int: fk_piece
     *
     * @return bool
     */
    public function isValidPiece ($piece) {
	return ($this->_validate($piece, 'int')) ? true : false;
    }

    /* check, if name is valid
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($this->_validate($name, 'string')) ? true : false;
    }

    /* check, if value is valid
     * @param string: value
     *
     * @return bool
     */
    public function isValidValue ($value) {
	return ($this->_validate($value, 'extString')) ? true : false;
    }

    /* delete bit
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }
}
?>
