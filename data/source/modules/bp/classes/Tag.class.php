<!-- | CLASS Tag -->
<?php
class $$$Tag extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__tags";

    /* Type object
     * object
     */
    protected $Type;

    /* create new type
     * @param int: fk_type
     * @param string: name
     * @param string: title
     * @param string: description
     *
     * @return bool
     */
    public function create ($fk_type, $name, $title, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidFkType($fk_type)
	    OR !$this->isValidName($name)
	    OR !$this->isValidTitle($title)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'fk_type' => $fk_type,
	    'name' => $name,
	    'title' => $title,
	    'description' => $description,
	    'fk_account' => $TSunic->Usr->getInfo('id'),
	);
	return $this->_create($data);
    }

    /* edit type
     * @param int: fk_type
     * @param string: name
     * @param string: title
     * @param string: description
     *
     * @return bool
     */
    public function edit ($fk_type, $name, $title, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidFkType($fk_type)
	    OR !$this->isValidName($name)
	    OR !$this->isValidTitle($title)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'fk_type' => $fk_type,
	    'name' => $name,
	    'title' => $title,
	    'description' => $description,
	    'fk_account' => $TSunic->Usr->getInfo('id'),
	);
	return $this->_edit($data);
    }

    /* delete tag
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /* get selections (only if type=selection/radio)
     *
     * @return array
     */
    public function getSelections () {
	if ($this->getType()->getInfo('name') != 'selection'
	    AND $this->getType()->getInfo('name') != 'radio'
	) return array();
	global $TSunic;

	// get all selections
	$sql = "SELECT id
	    FROM #__selections
	    WHERE fk_tag = '$this->id'
	    ORDER BY id
	;";
	$result = $TSunic->Db->doSelect($sql);

	// to objects
	$out = array();
	foreach ($result as $index => $values) {
	    $out[] = $TSunic->get('$$$Selection', $values['id']);
	}

	return $out;
    }

    /* get value of selection
     *
     * @return mix
     */
    public function getSelectionValue ($value) {
	if (!is_numeric($value)) return NULL;

	// get all selections
	$selections = $this->getSelections();

	return (count($selections) > $value) ? $selections[$value]->getInfo('name') : NULL;
    }

    /* get Type object
     *
     * @return object
     */
    public function getType () {
	global $TSunic;
	if (empty($this->Type)) {
	    $this->Type = $TSunic->get('$$$Type', $this->getInfo('fk_type'));
	}
	return $this->Type;
    }

    /* is valid name?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($name and $this->_validate($name, 'string')
	) ? true : false;
    }

    /* is valid title?
     * @param string: title
     *
     * @return bool
     */
    public function isValidTitle ($title) {
	return (empty($title) or $this->_validate($title, 'extString')
	) ? true : false;
    }

    /* is valid description?
     * @param string: description
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return (empty($description) or $this->_validate($description, 'extString')
	) ? true : false;
    }

    /* is valid fk_type?
     * @param int: fk_type
     *
     * @return bool
     */
    public function isValidFkType ($fk_type) {
	return ($fk_type and $this->_validate($fk_type, 'int')
	    and $this->_isObject('#__types', $fk_type)
	) ? true : false;
    }

    /* is valid value for this tag?
     * @param string: value
     *
     * @return bool
     */
    public function isValidValue ($value) {
	return $this->getType()->isValidValue($value);
    }

    /* get all available types
     *
     * @return array
     */
    public function getAllTypes () {
	global $TSunic;

	// get all tags in database
	$sql = "SELECT id
	    FROM #__types
	    WHERE fk_account = '0'
		OR fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$out = array();
	foreach ($result as $index => $values) {
	    $out[] = $TSunic->get('$$$Type', $values['id']);
	}

	return $out;
    }
}
?>
