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

		return $this->checkGroups($name);
	}

	/* has user access by group?
	 * @param string: name of access
	 *
	 * @return bool
	 */
	public function checkGroups ($name) {
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

		$sql = "SELECT fk_accessgroup as id
			FROM #__accessgroupmembers
			WHERE fk_account = '$this->fk_account';";
		$result = $TSunic->Db->doSelect($sql);
		if (!$result) return $result;

		// create objects
		$this->groups = array();
		$this->groups[] = $TSunic->get('$$$Accessgroup', 1);
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

		// access?
		if (!$TSunic->Usr->access('$$$editAllAccess')) return false;

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
	public function joinGroup ($fk_accessgroup) {
		global $TSunic;
		$Group = $TSunic->get('$$$Accessgroup', $fk_accessgroup);
		return $Group->addMember($this->id);
	}

	/* remove user from accessgroup
	 * @param int: ID of accessgroup
	 *
	 * @return bool
	 */
	public function leaveGroup ($fk_accessgroup) {
		global $TSunic;
		$Group = $TSunic->get('$$$Accessgroup', $fk_accessgroup);
		return $Group->rmMember($this->id);
	}

	/* get all available accessnames
	 *
	 * @return array/false
	 */
	public function getAccessnames () {
		global $TSunic;
		$sql = "SELECT name
			FROM #__accessnames
			ORDER BY name ASC;";
		$result = $TSunic->Db->doSelect($sql);

		// create output array
		$output = array();
		foreach ($result as $index => $values) {
			$output[$values['name']] = 1;
		}

		return $output;
	}
}
?>
