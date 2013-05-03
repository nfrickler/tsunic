<!-- | CLASS Meta -->
<?php
/** Meta class for profile module
 *
 * This class offers helper methods
 */
class $$$Meta {

    /** Get MyProfile for certain fk_account
     * @param int $fk_account
     *	Fk_account of MyProfile
     *
     * @return bool
     */
    public function getMyProfile ($fk_account = false) {
	global $TSunic;
	if (empty($fk_account)) $fk_account = $TSunic->Usr->getInfo('id');

	// get object with this id
	$Helper = $TSunic->get('$bp$Helper');
	$profiles = $Helper->getObjects(
	    '$$$MyProfile', "objects.fk_account = '".$fk_account."'"
	);

	return (count($profiles)) ? array_shift($profiles) : NULL;
    }
}
?>
