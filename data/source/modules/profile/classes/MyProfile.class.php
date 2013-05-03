<!-- | CLASS MyProfile -->
<?php
/** Main profile of user
 *
 * This object represents the main public Profile object of a user
 */
class $$$MyProfile extends $profile$Profile {

    /** MyProfiles cannot be deleted
     *
     * @return bool
     */
    public function delete () {
	return false;
    }
}
?>
