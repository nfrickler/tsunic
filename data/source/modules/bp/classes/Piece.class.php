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
	    $TSunic->get('$$$Key', array($this->table, 0));
	return $this->_Key;
    }

    /* create new piece
     *
     * @return bool
     */
    public function create () {

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

	// update database
	return $this->_delete();
    }

    /* get list of bits
     *
     * @return array/false
     */
    public function getBits () {
	global $TSunic;
	$sql = "SELECT name
	    FROM #__bits
	    WHERE fk_piece = '$this->id'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$output = array();
	foreach ($result as $index => $values) {
	    $output = $TSunic->get('$$$Bit', array($this->id, $values['name']));
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
	return $Bit->create($name, $value);
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
