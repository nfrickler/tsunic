<!-- | CLASS Accessgroup -->
<?php
class $$$Accessgroup extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__$usersystem$accessgroups";

    /* parent
     * OBJECT
     */
    protected $Parent;

    /* childs
     * array of OBJECTS
     */
    protected $childs;

    /* get default value for specific field
     * @param string: name of field
     *
     * @return mix
     */
    public function getDefault ($name) {
	switch ($name) {
	    case 'fk_parent':
		return 1;
	    default:
	}
	return NULL;
    }

    /* update data of this object (create/edit/delete)
     * @param string: name of value
     * @param mix: value
     * +@param bool: save all new infos?
     *
     * @return bool
     */
    public function set ($name, $value, $save = false) {

	// is valid fk_tag?
	switch ($name) {
	    case 'name':
		if (!$this->isValidName($value)) return false;
		break;
	    case 'fk_parent':
		if (!$this->isValidParent($value)) return false;
		break;
	    default:
	}

	return parent::set($name, $value, $save);
    }

    /* delete accessgroup
     *
     * @return bool
     */
    public function delete () {

	// don't delete "all" group
	if ($this->id == 1) return false;

	// update database
	return $this->_delete();
    }

    /* get list of members
     *
     * @return array/false
     */
    public function getMembers () {
	global $TSunic;
	$sql = "SELECT accounts.id as id,
		accounts.name as name
	    FROM #__$usersystem$accessgroupmembers as members,
		#__$usersystem$accounts as accounts
	    WHERE members.fk_accessgroup = '$this->id'
		AND members.fk_account = accounts.id
	;";
	$result = $TSunic->Db->doSelect($sql);

	// order for output
	$output = array();
	foreach ($result as $index => $values) {
	    $output[$values['id']] = $values['name'];
	}
	return $output;
    }

    /* is user/group member of this group?
     * @param int: account ID
     *
     * @return bool
     */
    public function isMember ($fk_account) {
	global $TSunic;
	$sql = "SELECT dateOfJoin
	    FROM #__$usersystem$accessgroupmembers
	    WHERE fk_accessgroup = '$this->id'
		AND fk_account = '$fk_account';";
	return ($TSunic->Db->doSelect($sql)) ? true : false;
    }

    /* add member to group
     * @param int: account ID
     *
     * @return bool
     */
    public function addMember ($fk_account) {
	global $TSunic;
	$sql = "INSERT INTO #__$usersystem$accessgroupmembers
	    SET fk_accessgroup = '$this->id',
		fk_account = '$fk_account'
	    ON DUPLICATE KEY UPDATE fk_account = '$fk_account'
	    ;";
	return $TSunic->Db->doInsert($sql);
    }

    /* remove member from group
     * @param int: account ID
     *
     * @return bool
     */
    public function rmMember ($fk_account) {
	global $TSunic;
	$sql = "DELETE FROM #__$usersystem$accessgroupmembers
	    WHERE fk_accessgroup = '$this->id'
		AND fk_account = '$fk_account';";
	return $TSunic->Db->doDelete($sql);
    }

    /* does group has access?
     * @param string: name of access
     * +@param bool: if nothing set, check parent?
     *
     * @return bool
     */
    public function check ($name, $goOn = true) {
	global $TSunic;

	// check own access
	$sql = "SELECT access as access
	    FROM #__$usersystem$access
	    WHERE fk__accessname = '$name'
		AND fk__owner = '$this->id'
		AND isUser = '0';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return false;

	if (count($result) > 0) {
	    return ($result[0]['access']) ? true : false;
	}
	if (!$goOn) return NULL;

	// check parent object for access
	return $this->checkParent($name);
    }

    /* check access of parent group
     * @param string: name of access
     *
     * @return bool
     */
    public function checkParent ($name) {
	return ($this->getParent())
	    ? $this->getParent()->check($name)
	    : false;
    }

    /* set access
     * @param string: name of access
     * @param bool/NULL: value
     *
     * @return bool
     */
    public function setAccess ($name, $value) {
	global $TSunic;

	// set to default?
	if ($value === NULL) {
	    $sql = "DELETE FROM #__$usersystem$access
		WHERE fk__owner = '$this->id'
		    AND isUser = '0'
		    AND fk__accessname = '$name';";
	    return $TSunic->Db->doDelete($sql);
	}

	// update database
	$sql = "INSERT INTO #__$usersystem$access
	    SET fk__owner = '$this->id',
		isUser = '0',
		fk__accessname = '$name',
		access = '".($value ? "1" : "0")."'
	    ON DUPLICATE KEY UPDATE access = '".($value ? "1" : "0")."';";
	return $TSunic->Db->doInsert($sql);
    }

    /* is valid name for accessgroup?
     * @param string: name
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($this->_validate($name, 'string')
	    and $this->_isUnique('#__$usersystem$accessgroups', 'name', $name)
	) ? true : false;
    }

    /* is valid fk_parent for accessgroup?
     * @param int: ID of an accessgroup
     *
     * @return bool
     */
    public function isValidParent ($fk_parent) {
	return ($this->_validate($fk_parent, 'int')
	    and $this->_isObject('#__$usersystem$accessgroups', $fk_parent)
	    and !$this->isInChildren($fk_parent)
	) ? true : false;
    }

    /* is accessgroup within childrens of this group?
     * @param int: ID of an accessgroup
     *
     * @return bool
     */
    public function isInChildren ($id) {

	// own child?
	$children = $this->getChildren();
	foreach ($children as $index => $Child) {
	    if ($Child->getInfo('id') == $id) return true;
	}

	// check for each child
	foreach ($children as $index => $Child) {
	    if ($Child->isInChildren($id)) return true;
	}

	return false;
    }

    /* get parent object
     *
     * @return OBJECT
     */
    public function getParent () {
	if (!empty($this->Parent)) return $this->Parent;
	if ($this->getInfo('id') == 1) return NULL;
	global $TSunic;
	$this->Parent = $TSunic->get('$$$Accessgroup', $this->getInfo('fk_parent'));
	return ($this->Parent->isValid()) ? $this->Parent : NULL;
    }

    /* get array of child objects
     *
     * @return array
     */
    public function getChildren () {
	if ($this->id == 0) return array();
	if (!empty($this->childs)) return $this->childs;
	global $TSunic;

	// get childs from database
	$sql = "SELECT id
	    FROM #__$usersystem$accessgroups
	    WHERE fk_parent = '$this->id';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return $result;

	// create objects
	$this->chlilds = array();
	foreach ($result as $index => $values) {
	    $this->childs[] = $TSunic->get('$$$Accessgroup', $values['id']);
	}
	return $this->childs;
    }
}
?>
