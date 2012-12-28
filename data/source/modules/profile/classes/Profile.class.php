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

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(

	// base
	'PROFILE__FIRSTNAME',
	'PROFILE__LASTNAME',
	'PROFILE__SEX',
	'PROFILE__DATEOFBIRTH',
	'PROFILE__PLACEOFBIRTH',
	'PROFILE__DATEOFDEATH',

	// contact
	'PROFILE__EMAIL',
	'PROFILE__CITY',
	'PROFILE__ADDRESS',
	'PROFILE__TELEFONE',

	// you and him/her
	'PROFILE__DATEOFFIRSTMEET',
	'PROFILE__DATEOFLASTMEET',

	// appearance
	'PROFILE__HAIR',
	'PROFILE__HAIRCOLOR',
	'PROFILE__BODYSHAPE',

	// character
	'PROFILE__HOBBY',
	'PROFILE__STRENGTH',
	'PROFILE__WEAKNESS',
	'PROFILE__RELIGION',

	// job
	'PROFILE__JOB',
	'PROFILE__INCOME',

	// owner
	'PROFILE__OBJECT',
    );

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
}
?>
