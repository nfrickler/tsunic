<!-- | CLASS Profile -->
<?php
class $$$Profile extends $system$Object {

    /* table
     * string
     */
    protected $table = "#__profiles";

    /* register user
     * @param string: firstname
     * @param string: lastname
     *
     * @return bool
     */
    public function create ($firstname, $lastname) {

	// validate input
	if (!$this->isValidFirstname($firstname)
	    OR !$this->isValidLastname($lastname)
	) return false;
	
	// update database
	global $TSunic;
	$data = array(
	    "firstname" => $firstname,
	    "firstname" => $lastname,
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
