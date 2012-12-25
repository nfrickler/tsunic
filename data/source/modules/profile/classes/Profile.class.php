<!-- | CLASS Profile -->
<?php
class $$$Profile extends $bp$BpObject {

    /* table
     * string
     */
    protected $table = "#__profiles";

    /* TAG of this object
     * string
     */
    protected $tag = "PROFILE__ID";

    /* create new profile
     *
     * @return bool
     */
    public function create () {

	// update database
	global $TSunic;
	$data = array(
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "dateOfCreation" => "NOW()"
	);
	return $this->_create($data);
    }

    /* edit profile
     *
     * @return bool
     */
    public function edit () {
	global $TSunic;

    }

    /* delete profile
     *
     * @return bool
     */
    public function delete () {

	// remove in database
	return $this->_delete();
    }
}
?>
