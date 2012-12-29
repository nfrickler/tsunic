<!-- | CLASS Type -->
<?php
class $$$Type extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__types";

    /* create new type
     *
     * @return bool
     */
    public function create ($name, $title, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidName($name)
	    OR !$this->isValidTitle($title)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'name' => $name,
	    'title' => $title,
	    'description' => $description
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
