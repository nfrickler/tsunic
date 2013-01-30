<!-- | CLASS Type -->
<?php
class $$$Type extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__types";

    /* create
     *
     * @return bool
     */
    public function create () {
	return false;
    }

    /* edit
     *
     * @return bool
     */
    public function edit () {
	return false;
    }

    /* delete
     *
     * @return bool
     */
    public function delete () {
	return false;
    }

    /* is valid value for this type?
     * @param string: value
     *
     * @return bool
     */
    public function isValidValue ($value) {

	// always allow empty values
	if (empty($value)) return true;

	// get typename
	$typename = $this->getInfo('name');

	// is object?
	if (substr($typename, 0, 3) == 'mod') {
	    global $TSunic;
	    $Obj = $TSunic->get('$$$BpObject', $value);
	    $Obj = $Obj->getObject();
	    return (get_class($Obj) == $typename) ? true : false;
	}

	// check if value matches type conventions
	switch ($this->getInfo('name')) {
	    case 'int':
		return ($this->_validate($value, 'int'));
		break;
	    case 'double':
		return ($this->_validate($value, 'double'));
		break;
	    case 'string':
		return ($this->_validate($value, 'extString'));
		break;
	    case 'text':
		return ($this->_validate($value, 'extString'));
		break;
	    case 'selection':
		return ($this->_isObject('#__selections', $value));
		break;
	    case 'radio':
		return ($this->_isObject('#__selections', $value));
		break;
	    default:
		global $TSunic;
		$TSunic->Log->log(3, 'Error: $bp$Type missing name='.$typename.'!');
		return false;
	}

	return false;
    }
}
?>
