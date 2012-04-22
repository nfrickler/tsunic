<!-- | Accessgroup class -->
<?php
include_once '$system$Object.class.php';
class $$$Accessgroup extends $system$Object {

	/* parent
	 * OBJECT
	 */
	protected $Parent;

	/* childs
	 * array of OBJECTS
	 */
	protected $childs;

	/* load infos from database
	 *
	 * @return sql query
	 */
	protected function _loadInfoSql () {
		return "SELECT name,
				dateOfCreation,
				dateOfUpdate,
				dateOfDeletion,
				fk_parent as fk_parent
			FROM #__accessgroups
			WHERE id = '$this->id';";
	}

	/* create new accessgroup
	 * @param string: name
	 * +@param int: fk of parent
	 *
	 * @return bool
	 */
	public function create ($name, $fk_parent = 0) {

		// validate
		if (!$this->isValidName($name)
			or !$this->isValidParent($fk_parent)) {
			return false;
		}

		// update database
		$sql = "INSERT INTO #__accessgroups
			SET name = '$name',
				fk_parent = '$fk_parent';";
		return $this->_create($sql);
	}

	/* edit accessgroup
	 * @param string: new name
	 * +@param int: fk of parent
	 *
	 * @return bool
	 */
	public function edit ($name, $fk_parent) {

		// validate
		if (!$this->isValidName($name)
			or !$this->isValidParent($fk_parent)) {
			return false;
		}

		// anything changed?
		$sql_set = array();
		if ($name != $this->getInfo('name')) {
			$sql_set[] = "name = '$name'";
		}
		if ($fk_parent != $this->getInfo('fk_parent')) {
			$sql_set[] = "fk_parent = '$fk_parent'";
		}
		if (empty($sql_set)) return true;

		// update database
		$sql = "UPDATE #__accessgroups SET ".
			implode(",", $sql_set).
			"WHERE id = '$this->id';";
		return $this->_edit($sql);
	}

	/* delete accessgroup
	 *
	 * @return bool
	 */
	public function delete () {

		// update database
		$sql = "DELETE FROM #__accessgroups
			WHERE id = '$this->id';";
		return $this->_delete($sql);
	}

	/* get list of members
	 *
	 * @return array/false
	 */
	public function getMembers () {
		global $TSunic;
		$sql = "SELECT fk_account as fk_account,
			FROM #__accessgroupmembers
			WHERE fk_accessgroup = '$this->id';";
		return $TSunic->Db->doSelect($sql);
	}

	/* is user/group member of this group?
	 * @param int: account ID
	 *
	 * @return bool
	 */
	public function isMember ($fk_account) {
		global $TSunic;
		$sql = "SELECT dateOfJoin
			FROM #__accessgroupmembers
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
		$sql = "INSERT INTO #__accessgroupmembers
			SET fk_accessgroup = '$this->id',
				fk_account= '$fk_account';";
		return $TSunic->Db->doInsert($sql);
	}

	/* remove member from group
	 * @param int: account ID
	 *
	 * @return bool
	 */
	public function rmMember ($fk_account) {
		global $TSunic;
		$sql = "DELETE FROM #__accessgroupmembers
			WHERE fk_accessgroup = '$this->id'
				AND fk_account = '$fk_account';";
		return $TSunic->Db->doDelete($sql);
	}

	/* does group has access?
	 * @param string: name of access
	 *
	 * @return bool
	 */
	public function check ($name) {
		global $TSunic;

		// check own access
		$sql = "SELECT access
			FROM #__access
			WHERE fk__accessname = '$name'
				AND fk__owner = '$this->id'
				AND isUser = '0';";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return false;
		if (count($result) > 0) {
			return ($result[0]['access']) ? true : false;
		}

		// check parent object for access
		if ($this->getParent()) {
			return $this->getParent()->check($name);
		}

		// check default access
		return $TSunic->get('$$$User', 'default')->access($name);
	}

	/* set access
	 * @param string: name of access
	 * @param bool/NULL: value
	 *
	 * @return bool
	 */
	public function set ($name, $value) {
		global $TSunic;

		// set to default?
		if ($value === NULL) {
			$sql = "DELETE FROM #__access
				WHERE fk__owner = '$this->id'
					AND isUser = '0'
					AND fk__accessname = '$name';";
			return $TSunic->Db->doDelete($sql);
		}

		// TODO: update if already exists
		$sql = "INSERT INTO #__access
			SET fk__owner = '$this->id',
				isUser = '0',
				fk__accessname = '$name',
				value = '".($value ? "1" : "0")."'
			ON DUPLICATE KEY UPDATE value = '".($value ? "1" : "0")."';";
		return $TSunic->Db->doInsert($sql);
	}

	/* is valid name for accessgroup?
	 * @param string: name
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		return ($this->_validate($name, 'string')
			and $this->_isUnique('#__accessgroups', 'name', $name)
		) ? true : false;
	}

	/* is valid fk_parent for accessgroup?
	 * @param int: ID of an accessgroup
	 *
	 * @return bool
	 */
	public function isValidParent ($fk_parent) {
		return ($this->_validate($fk_parent, 'int')
			and $this->_isObject('#__accessgroups', $fk_parent)
		) ? true : false;
	}

	/* get parent object
	 *
	 * @return OBJECT
	 */
	public function getParent () {
		if (!empty($this->Parent)) return $this->Parent;
		global $TSunic;
		$this->Parent = $TSunic->get('$$$Accessgroup', $this->getInfo('fk_parent'));
		return $this->Parent;
	}

	/* get array of child objects
	 *
	 * @return array
	 */
	public function getChilds () {
		if (!empty($this->childs)) return $this->childs;
		global $TSunic;

		// get childs from database
		$sql = "SELECT id
			FROM #__accessgroups
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
