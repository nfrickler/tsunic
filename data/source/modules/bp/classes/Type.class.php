<!-- | CLASS Type -->
<?php
/** Type class
 *
 * Every Tag has a Type that defines the kind of value, it holds.
 */
class $$$Type extends $system$Object {

    /** Table
     * @var string $table
     */
    protected $table = "#__$bp$types";

    /** Create
     *
     * @return bool
     */
    public function create () {
	return false;
    }

    /** Edit
     *
     * @return bool
     */
    public function edit () {
	return false;
    }

    /** Delete
     *
     * @return bool
     */
    public function delete () {
	return false;
    }

    /** Is valid value for this type?
     * @param string $value
     *	Value
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
	switch ($typename) {
	    case 'int':
	    case 'date':
	    case 'timestamp':
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
		return ($this->_isObject('#__$bp$selections', $value));
		break;
	    case 'radio':
		return ($this->_isObject('#__$bp$selections', $value));
		break;
	    default:
		global $TSunic;
		$TSunic->Log->log(3, 'Error: $bp$Type missing name='.$typename.'!');
		return false;
	}

	return false;
    }

    /** Is empty value concerning this type?
     * @param mix $value
     *	Value to check
     *
     * @return bool
     */
    public function isEmpty ($value) {
	if ($value === '' or $value === NULL) return true;

	// get typename
	$typename = $this->getInfo('name');

	// is object?
	if (substr($typename, 0, 3) == 'mod') {
	    return (empty($value)) ? true : false;
	}

	switch ($typename) {
	    case 'selection':
	    case 'radio':
		return (empty($value)) ? true : false;
	    case 'double':
	    case 'string':
	    case 'text':
	    case 'int':
	    case 'date':
	    case 'timestamp':
	    default:
		return false;
	}

	return false;
    }
}
?>
