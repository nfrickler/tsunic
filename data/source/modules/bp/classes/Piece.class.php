<!-- | CLASS Piece -->
<?php
class $$$Piece extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__pieces";

    /* all bits of this piece
     * array
     */
    protected $bits;

    /* get Key for all pieces
     *
     * @return Object
     */
    public function getKey () {
	return $this->_getKey();
    }

    /* load Key (all pieces have same Key to enable searching)
     *
     * @return Object
     */
    protected function _getKey () {
	global $TSunic;
	if (!$this->_Key) $this->_Key =
	    $TSunic->get('$system$Key', array($this->table, 1));
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

    /* create new piece
     *
     * @return bool
     */
    public function create () {
	global $TSunic;

	// update database
	$data = array(
	    'author' => $TSunic->Usr->getInfo('name'),
	);
	return $this->_create($data);

    }

    /* edit piece
     *
     * @return bool
     */
    public function edit () {
	return true;
    }

    /* delete piece
     *
     * @return bool
     */
    public function delete () {

	// delete all bits of this piece
	$bits = $this->getBits();
	foreach ($bits as $index => $Value) {
	    $Value->delete();
	}

	// keep key!
	return $this->_delete();
    }

    /* get list of bits
     *
     * @return array/false
     */
    public function getBits () {
	global $TSunic;
	$Key = $this->getKey();
	$sql = "SELECT _name_ as name,
		_value_ as value
	    FROM #__bits
	    WHERE fk_piece = '$this->id'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$output = array();
	foreach ($result as $index => $values) {
	    $values['name'] = $Key->decrypt($values['name']);
	    $values['value'] = $Key->decrypt($values['value']);
	    $output[] = $TSunic->get('$$$Bit', array(
		$this->id,
		$values['name'],
		$values['value']
	    ));
	}
	return $output;
    }

    /* get bit with certain name
     * @param string: name
     *
     * @return $$$Bit
     */
    public function getBit ($name) {

	// get all bits
	$bits = $this->getBits();

	// search for bit
	foreach ($bits as $index => $Value) {
	    if ($Value->getInfo('name') == $name) return $Value;
	}

	return NULL;
    }

    /* add bit to piece
     * @param string: name
     * @param string: value
     *
     * @return bool
     */
    public function addBit ($name, $value) {
	global $TSunic;

	// get empty Bit
	$Bit = $TSunic->get('$$$Bit');

	// create new Bit
	return $Bit->create($this->id, $name, $value);
    }

    /* remove bit from piece
     * @param string: name
     *
     * @return bool
     */
    public function rmBit ($name) {
	global $TSunic;
	$Bit = $TSunic->get('$$$Bit', array($this->id, $name));
	return $Bit->delete();
    }
}
?>
