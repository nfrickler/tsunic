<!-- | Inbox class -->
<?php
include_once '$$$Mailbox.class.php';
class $$$Inbox extends $$$Mailbox {

    /* get information about mailbox
     * +@param string/bool: name of info (true will return $this->info)
     *
     * @return string/int/array
     */
    public function getInfo ($name = true) {
	global $TSunic;

	// set info
	if (empty($this->info)) {

	    // set
	    $this->info = array(
		'name' => '{INBOX__NAME}',
		'description' => '{INBOX__DESCRIPTION}',
		'dateOfCreation' => 0,
		'id' => 0
	    );
	}

	// return requested info
	if ($name === true) return $this->info;
	if (isset($this->info[$name])) return $this->info[$name];
	return false;
    }

    /* get object of mails in box
     *
     * @return array
     */
    public function getMails () {
	global $TSunic;

	// check, if info already in obj-vars
	if (!empty($this->mails)) return $this->mails;

	// get ids of mails
	$sql = "SELECT mails.id as id
	    FROM #__mails as mails
	    WHERE fk_account = '".$TSunic->Usr->getInfo('id')."'
		AND fk_mailbox = '0'
		AND dateOfDeletion = '0000-00-00 00:00:00';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// create and store objects
	$this->mails = array();
	foreach ($result as $index => $value) {
	    $this->mails[] = $TSunic->get('$$$Mail', array($value['id']));
	}

	return $this->mails;
    }

    /* create a new mailbox
     * @param string: name of mailbox
     * +@param string: description of box
     *
     * @return bool
     */
    public function create ($name, $description = '') {
	return false;
    }

    /* edit data of box
     * @param string: name of mailbox
     * @param string: description of box
     *
     * @return bool
     */
    public function edit ($name, $description) {
	return false;
    }

    /* check, if name of box is valid
     * @param string: name of mailbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return false;
    }

    /* check, if description of box is valid
     * @param string: description of mailbox
     *
     * @return bool
     */
    public function isValidDescription ($description) {
	return false;
    }

    /* delete mailbox
     *
     * @return bool
     */
    public function delete () {
	return false;
    }
}
?>
