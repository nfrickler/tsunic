<!-- | CLASS Meta -->
<?php
class $$$Meta {

    /* get MyProfile to certain fk_account
     * @param int: fk_account of MyProfile
     *
     * @return bool
     */
    public function getMyProfile ($fk_account = false) {
	global $TSunic;
	if (empty($fk_account)) $fk_account = $TSunic->Usr->getInfo('id');

	// get object with this id
	$Helper = $TSunic->get('$bp$Helper');
	$profiles = $Helper->getObjects(
	    '$$$MyProfile', "fk_account = '".$fk_account."'"
	);

	return (isset($profiles[0])) ? $profiles[0] : NULL;
    }
}
?>
