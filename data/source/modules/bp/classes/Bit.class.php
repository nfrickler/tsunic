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

    /* get information about object (enabling setDummy)
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

	// nothing found (load if not loaded yet)
	if (!$this->info_isloaded) return $this->getInfo($name, true);

	return NULL;
    }

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

    /* set dummy values
     * @param int: fk_tag
     *
     * @return bool
     */
    public function setDummy ($fk_tag) {
	$this->info = array('fk_tag' => $fk_tag);
	return true;
    }

    /* create new bit
     * @param int: fk_object
     * @param string: value
     * +@param int: fk_tag
     *
     * @return bool
     */
    public function create ($fk_object, $value, $fk_tag = 0) {

	// validate input
	if (!$this->isValidFkTag($fk_tag)
	    or !$this->isValidFkObject($fk_object)
	) return false;
	$this->presetInfo(array('fk_tag' => $fk_tag));

	// valid value?
	if ($value === true) {
	    $value = "";
	} else {
	    $value = $this->value2save($value);
	    if (!$this->isValidValue($value)) return false;
	}

	// update database
	global $TSunic;
	$data = array(
	    "fk_object" => $fk_object,
	    "value" => $value,
	    "fk_tag" => $fk_tag,
	    'dateOfCreation' => 'NOW()'
	);
	if (!$this->_create($data)) return false;

	return $this->id;
    }

    /* edit bit (if value === "" or == 0 for selection/radio, Bit will be deleted)
     * @param string: value
     *
     * @return bool
     */
    public function edit ($value) {
	if (!$this->isValid()) return false;
	global $TSunic;

	// delete?
	if ($value === NULL or $value === ""
	    or (in_array($this->getTag()->getType()->getInfo('name'), array('selection', 'radio')) and empty($value))
	) {
	    return $this->delete();
	}

	// validate input
	$value = $this->value2save($value);
	if (!$this->isValidValue($value)) return false;

	// update database
	global $TSunic;
	$data = array(
	    "value" => $value
	);
	if (!$this->_edit($data)) return false;

	return true;
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
}
?>
