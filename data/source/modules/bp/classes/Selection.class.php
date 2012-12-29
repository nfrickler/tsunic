<!-- | CLASS Selection -->
<?php
class $$$Selection extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__selections";

    /* create new selection
     * @param int: fk_tag
     * @param string: name
     * @param string: description
     *
     * @return bool
     */
    public function create ($fk_tag, $name, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidName($name)
	    OR !$this->isValidFkTag($fk_tag)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'fk_tag' => $fk_tag,
	    'name' => $name,
	    'description' => $description
	);
	return $this->_create($data);
    }

    /* edit type
     * @param string: name
     * @param string: description
     *
     * @return bool
     */
    public function edit ($name, $description) {
	global $TSunic;

	// validate
	if (!$this->isValidName($name)
	    OR !$this->isValidDescription($description)) {
	    return false;
	}

	// update database
	$data = array(
	    'name' => $name,
	    'description' => $description
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

    /* is valid name?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($name and $this->_validate($name, 'string')
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

    /* is valid fk_tag?
     * @param int: fk_tag
     *
     * @return bool
     */
    public function isValidFkTag ($fk_tag) {
	return ($fk_tag and $this->_validate($fk_tag, 'int')
	    and $this->_isObject('#__tags', $fk_tag)
	) ? true : false;
    }

    /* get all available tags
     *
     * @return array
     */
    public function getAllTags () {
	global $TSunic;

	// get all tags in database
	$sql = "SELECT id
	    FROM #__tags
	    WHERE fk_account = '0'
		OR fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$out = array();
	foreach ($result as $index => $values) {
	    $out[] = $TSunic->get('$$$Tag', $values['id']);
	}

	return $out;
    }
}
?>
