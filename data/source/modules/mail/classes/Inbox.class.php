<!-- | CLASS Inbox -->
<?php
class $$$Inbox extends $$$Mailbox {

    /* get information about mailbox
     * +@param string/bool: name of info (true will return $this->info)
     *
     * @return string/int/array
     */
    public function getInfo ($name = true, $update = false) {
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
	if (!empty($this->mails)) return $this->mails;
	global $TSunic;

	// get all mails
	$BpHelper = $TSunic->get('$bp$Helper');
	$mails = $BpHelper->getObjects('$$$Mail');

	// find those mails which are in this mailbox
	$this->mails = array();
	foreach ($mails as $index => $Value) {
	    if ($Value->getInfo('box') == 0)
		$this->mails[] = $Value;
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
    public function edit ($name, $description = '') {
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
