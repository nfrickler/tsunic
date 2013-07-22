<!-- | CLASS Link -->
<?php
/** Link object
 *
 * Links represent relations between objects
 */
class $$$Link extends $system$Object {

    /** Table
     * @var string $table
     */
    protected $table = "#__$bp$links";

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

	switch ($name) {
	    case 'fk_obj1':
	    case 'fk_obj2':
		if (!$this->isValidObject($value)) return false;
		break;
	}

	return true;
    }

    /** Create new Link
     * @param int $fk_obj1
     *	Id of first object
     * @param int $fk_obj2
     *	Id of second object
     * @param bool $forward
     *	Forward relation
     * @param bool $backward
     *	Backward relation
     *
     * @return bool
     */
    public function create ($fk_obj1, $fk_obj2, $forward, $backward) {

	// update database
	$data = array(
	    'fk_obj1' => $fk_obj1,
	    'fk_obj2' => $fk_obj2,
	    'forward' => $forward,
	    'backward' => $backward,
	);
	return $this->_create($data);
    }

    /** Edit Link
     * @param int $fk_obj1
     *	Id of first object
     * @param int $fk_obj2
     *	Id of second object
     * @param bool $forward
     *	Forward relation
     * @param bool $backward
     *	Backward relation
     *
     * @return bool
     */
    public function edit ($fk_obj1, $fk_obj2, $forward, $backward) {

	// update database
	$data = array(
	    'fk_obj1' => $fk_obj1,
	    'fk_obj2' => $fk_obj2,
	    'forward' => $forward,
	    'backward' => $backward,
	);
	return $this->_edit($data);
    }

    /** Delete Link
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /** Is valid object?
     * @param int $obj
     *	Object id
     *
     * @return bool
     */
    public function isValidObject($obj) {
	return ($this->_isObject('#__$bp$objects', $obj)) ? true : false;
    }

    /* Get linked object. Use the object given as param as base and return the
     * other one
     *
     * @param BpObject object
     *	Base object
     *
     * @return BpObject
     */
    public function getObject ($object) {
	global $TSunic;
	$fk_obj = ($this->getInfo('fk_obj1') == $object->getInfo('id'))
	    ? $this->getInfo('fk_obj2') : $this->getInfo('fk_obj1');
	$Obj = $TSunic->get('$$$BpObject', $fk_obj);
	return ($Obj) ? $Obj->getObject() : null;
    }
}
?>
