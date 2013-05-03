<!-- | CLASS Access -->
<?php
/** Regulation of access of users
 *
 * This class provides an interface for user access management
 */
class $$$Access {

    /** Access groups of user
     * @var array $groups
     */
    protected $groups;

    /** Account ID
     * @var int $fk_account
     */
    protected $fk_account;

    /** Constructor
     * @param int $fk_account
     *	Account ID
     */
    public function __construct ($fk_account) {
	$this->fk_account = $fk_account;
    }

    /** User has access permission?
     * @param string $name
     *	Name of access
     * @param bool $goOn
     *	Check groups for permission additionally?
     *
     * @return bool
     */
    public function check ($name, $goOn = true) {
	global $TSunic;
	if ($this->fk_account == 1) return true;

	// check own access
	$sql = "SELECT access as access
	    FROM #__$usersystem$access
	    WHERE isUser = '1'
		AND fk__owner = '$this->fk_account'
		AND fk__accessname = '$name';";
	$result = $TSunic->Db->doSelect($sql);

	if ($result === false) return false;
	if (count($result) > 0) {
	    return ($result[0]['access']) ? true : false;
	}
	if (!$goOn) return NULL;

	return $this->checkGroups($name);
    }

    /** Has user access permission by group?
     * @param string $name
     *	Name of access
     *
     * @return bool
     */
    public function checkGroups ($name) {
	foreach ($this->getGroups() as $index => $Group) {
	    if ($Group->check($name)) return true;
	}
	return false;
    }

    /** Get accessgroups the user is in
     *
     * @return bool
     */
    public function getGroups () {
	if ($this->groups) return $this->groups;
	global $TSunic;

	$sql = "SELECT fk_accessgroup as id
	    FROM #__$usersystem$accessgroupmembers
	    WHERE fk_account = '$this->fk_account';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return $result;

	// create objects
	$this->groups = array();
	$this->groups[] = $TSunic->get('$$$Accessgroup', 1);
	foreach ($result as $index => $values) {
	    $this->groups[] = $TSunic->get('$$$Accessgroup', $values['id']);
	}

	return $this->groups;
    }

    /** Get all accessgroups
     *
     * @return array
     */
    public function allGroups () {
	global $TSunic;

	// get all groups from database
	$sql = "SELECT id, name
	    FROM #__$usersystem$accessgroups;";
	$results = $TSunic->Db->doSelect($sql);
	if (!$results) return array();

	// create output array
	$output = array();
	foreach ($results as $index => $values) {
	    $output[$values['id']] = $values['name'];
	}

	return $output;
    }

    /** Set access
     * @param string $name
     *	Vame of access
     * @param bool|NULL $value
     *	Value (NULL will delete access information)
     *
     * @return bool
     */
    public function setAccess ($name, $value) {
	global $TSunic;

	// access?
	if (!$TSunic->Usr->access('$$$editAllAccess')) return false;

	// set to default?
	if ($value === NULL) {
	    $sql = "DELETE FROM #__$usersystem$access
		WHERE fk__owner = '$this->fk_account'
		    AND isUser = '1'
		    AND fk__accessname = '$name';";
	    return $TSunic->Db->doDelete($sql);
	}

	// udpate database
	$sql = "INSERT INTO #__$usersystem$access
	    SET fk__owner = '$this->fk_account',
		isUser = '1',
		fk__accessname = '$name',
		access = '".($value ? "1" : "0")."'
	    ON DUPLICATE KEY UPDATE access = '".($value ? "1" : "0")."';";
	return $TSunic->Db->doInsert($sql);
    }

    /** Add user to accessgroup
     * @param int $fk_accessgroup
     *	ID of accessgroup
     *
     * @return bool
     */
    public function joinGroup ($fk_accessgroup) {
	global $TSunic;
	$Group = $TSunic->get('$$$Accessgroup', $fk_accessgroup);
	return $Group->addMember($this->id);
    }

    /** Remove user from accessgroup
     * @param int $fk_accessgroup
     *	ID of accessgroup
     *
     * @return bool
     */
    public function leaveGroup ($fk_accessgroup) {
	global $TSunic;
	$Group = $TSunic->get('$$$Accessgroup', $fk_accessgroup);
	return $Group->rmMember($this->id);
    }

    /** Get all available accessnames
     *
     * @return array|false
     */
    public function getAccessnames () {
	global $TSunic;
	$sql = "SELECT name
	    FROM #__$usersystem$accessnames
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
