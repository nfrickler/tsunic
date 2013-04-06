<!-- | CLASS Inbox -->
<?php
class $$$Inbox extends $$$Mailbox {

    /* get default value for specific field
     * @param string: name of field
     *
     * @return mix
     */
    public function getDefault ($name) {
	switch ($name) {
	    case 'name':
		return '{INBOX__NAME}';
	    case 'description':
		return '{INBOX__DESCRIPTION}';
	    default:
	}
	return NULL;
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

    /* always valid
     *
     * @return bool
     */
    public function isValid () {
	return true;
    }
}
?>
