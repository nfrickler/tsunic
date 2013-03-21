<!-- | CLASS Bit -->
<?php
class $$$Bit extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = '#__$bp$bits';

    /* sub bits
     * array
     */
    protected $bits;

    /* load information about object
     *
     * @return bool
     */
    protected function _loadInfo () {
	if (!parent::_loadInfo()) return false;

	// if typename == mod, then check, if object exists
	$typename = $this->getTag()->getType()->getInfo('name');
	if (substr($typename,0,3) == 'mod' and !$this->_isObject('#__$bp$objects', $this->info['value'])) {
	    $this->info['value'] = 0;
	}

	return true;
    }

    /* get value to be showed
     *
     * @return mix
     */
    public function get2show () {
	$typename = $this->getTag()->getType()->getInfo('name');

	// is radio/selection?
	if ($typename == 'radio' or $typename == 'selection') {
	    global $TSunic;
	    $Selection = $TSunic->get('$$$Selection', $this->getInfo('value'));
	    return $Selection->getInfo('name');
	}

	// is fk?
	if (substr($typename,0,3) == 'mod') {
	    $Obj = $this->getFkObject();
	    return ($Obj) ? $Obj->getName() : 'Unknown';
	}

	return $this->getInfo('value');
    }

    /* get object, if typename == mod...
     *
     * @return object
     */
    public function getFkObject () {
	$typename = $this->getTag()->getType()->getInfo('name');
	if (substr($typename,0,3) != 'mod') return NULL;
	global $TSunic;
	$Obj = $TSunic->get('$$$BpObject', $this->getInfo('value'));
	return $Obj->getObject();
    }

    /* edit bit (empty values will be deleted)
     * @param string: value
     *
     * @return bool
     */
    public function edit ($value) {
	return $this->set('value', $value, true);
    }

    /* update data of this bit (create/edit/delete)
     * @param string: name of value
     * @param mix: value
     * +@param bool: save all new infos?
     *
     * @return bool
     */
    public function set ($name, $value, $save = false) {

	// is valid fk_tag?
	switch ($name) {
	    case 'fk_tag':
		if (!$this->isValidFkTag($value)) return false;
		break;
	    case 'fk_object':
		if (!$this->isValidFkObject($value)) return false;
		break;
	    case 'value':
		$value = $this->value2save($value);
		if (!$this->isValidValue($value)) return false;

		// do not save empty values
		$Type = $this->getType();
		if ($Type and $Type->isEmpty($value)) return true;

		break;
	    default:
	}

	return parent::set($name, $value, $save);
    }

    /* convert value in value to be saved
     * @param mix: value
     *
     * @return mix
     */
    public function value2save ($value) {
	return $this->getTag()->toid($value);
    }

    /* check, if fk_object is valid
     * @param int: fk_object
     *
     * @return bool
     */
    public function isValidFkObject ($fk_object) {
	return ($this->_validate($fk_object, 'int')
	    and $this->_isObject('#__$bp$objects', $fk_object)
	) ? true : false;
    }

    /* check, if fk_tag is valid
     * @param int: fk_tag
     *
     * @return bool
     */
    public function isValidFkTag ($fk_tag) {
	return (!$fk_tag or $this->_validate($fk_tag, 'int')
	    and $this->_isObject('#__$bp$tags', $fk_tag)
	) ? true : false;
    }

    /* check, if value is valid
     * @param mix: value
     *
     * @return bool
     */
    public function isValidValue ($value) {
	$Type = $this->getTag()->getType();
	return $Type->isValidValue($value);
    }

    /* delete bit
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /* get all sub bits
     *
     * @return array
     */
    public function getBits () {
	if ($this->bits) return $this->bits;
	global $TSunic;

	// get all bits from database
	$sql = "SELECT id
	    FROM #__$bp$bits
	    WHERE fk_bit = '$this->id'
	;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get objects
	$this->bits = array();
	foreach ($result as $index => $values) {
	    $this->bits[] = $TSunic->get('$$$Bit', $values['id']);
	}

	return $this->bits;
    }

    /* get Tag object
     *
     * @return object
     */
    public function getTag () {
	global $TSunic;
	return $TSunic->get('$$$Tag', $this->getInfo('fk_tag'));
    }

    /* get Type object
     *
     * @return object
     */
    public function getType () {
	$Tag = $this->getTag();
	if (!$Tag) return NULL;
	return $Tag->getType();
    }
}
?>
