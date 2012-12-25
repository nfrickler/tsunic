<!-- | CLASS MetaProfile -->
<?php
class $$$MetaProfile {

    /* get all profiles of this user
     *
     * @return array
     */
    public function getProfiles () {
	global $TSunic;

	// get from database
	$sql = "SELECT id
	    FROM #__profiles
	    WHERE fk_account = '".$TSunic->Usr->getInfo('id')."'";
	$result = $TSunic->Db->doSelect($sql);

	// get objects
	$out = array();
	foreach ($result as $index => $values) {
	    $out[] = $TSunic->get('$$$Profile', $values['id']);
	}

	return $out;
    }
}
?>
