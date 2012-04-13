<!-- | Access class -->
<?php
class $$$Access {

	/* access groups of user
	 * array of OBJECTS
	 */
	protected $groups;

	/* account ID
	 * int
	 */
	protected $fk_account;

	/* constructor
	 * @param int: account ID
	 */
	public function __construct ($fk_account) {
		$this->fk_account = $fk_account;
	}

	/* has user access?
	 * @param string: name of access
	 *
	 * @return bool
	 */
	public function check ($name) {
		global $TSunic;

		// check own access
		$sql = "SELECT access
			FROM #__Access
			WHERE isUser = '1'
				AND fk__owner = '$this->fk_account'
				AND fk__accessname = '$name';";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return false;
		if (count($result) > 0) {
			return ($result[0]['access']) ? true : false;
		}

		// is default user?
		if ($this->fk_account == 2) return false;

		// check groups for access
		$isAccess = false;
		foreach ($this->getGroups() as $index => $Group) {
			if ($Group->check($name)) $isAccess = true;
		}
		return $isAccess;
	}

	/* get accessgroups the user is in
	 *
	 * @return bool
	 */
	public function getGroups () {
		if ($this->groups) return $this->groups;
		global $TSunic;

		$sql = "SELECT fk_usersystem__accessgroups as id
			FROM #__accessgroupmembers
			WHERE isUser = '1'
				AND fk__owner = '$this->fk_account';";
		$result = $TSunic->Db->doSelect($sql);
		if (!$result) return $result;

		// create objects
		$this->groups = array();
		foreach ($result as $index => $values) {
			$this->groups[] = $TSunic->get('$$$Accessgroup', $values['id']);
		}

		return $this->groups;
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
				WHERE fk__owner = '$this->fk_account'
					AND isUser = '1'
					AND fk__accessname = '$name';";
			return $TSunic->Db->doDelete($sql);
		}

		// udpate database
		$sql = "INSERT INTO #__access
			SET fk__owner = '$this->fk_account',
				isUser = '1',
				fk__accessname = '$name',
				value = '".($value ? "1" : "0")."'
			ON DUPLICATE KEY UPDATE value = '".($value ? "1" : "0")."';";
		return $TSunic->Db->doInsert($sql);
	}

	/* add user to accessgroup
	 * @param int: ID of accessgroup
	 *
	 * @return bool
	 */
	public function addGroup ($id) {
		global $TSunic;
		$Group = $TSunic->get('$$$Accessgroup', $id);
		return $Group->addMember($this->id);
	}

	/* remove user from accessgroup
	 * @param int: ID of accessgroup
	 *
	 * @return bool
	 */
	public function rmGroup ($id) {
		global $TSunic;
		$Group = $TSunic->get('$$$Accessgroup', $id);
		return $Group->rmMember($this->id);
	}

	/* get all available accessnames
	 *
	 * @return array
	 */
	public function getAccessnames () {
		global $TSunic;
		$Accessfile = $TSunic->get('File', '#runtime#accessnames.inc.php');
		if (!$Accessfile->includeFile()) return false;
		return $TSunic->cache['$$$accessnames'];
	}
}
?>
