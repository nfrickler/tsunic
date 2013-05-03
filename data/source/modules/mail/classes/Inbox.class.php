<!-- | CLASS Inbox -->
<?php
/** Mailbox for incoming mails
 *
 * This mailbox collects all mails not belonging to another Mailbox
 */
class $$$Inbox extends $$$Mailbox {

    /** Get default value for specific field
     * @param string $name
     *	Name of field
     *
     * @return mix
     */
    public function getDefault ($name) {
	switch ($name) {
	    case 'id':
		return 0;
	    case 'name':
		return '{INBOX__NAME}';
	    case 'description':
		return '{INBOX__DESCRIPTION}';
	    default:
	}
	return NULL;
    }

    /** Get object of mails in box
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

    /** Create a new mailbox
     * @param string $name
     *	Name of mailbox
     * @param string $description
     *	Description of box
     *
     * @return bool
     */
    public function create ($name, $description = '') {
	return false;
    }

    /** Edit data of box
     * @param string $name
     *	Name of mailbox
     * @param string $description
     *	Description of box
     *
     * @return bool
     */
    public function edit ($name, $description = '') {
	return false;
    }

    /** Delete mailbox
     *
     * @return bool
     */
    public function delete () {
	return false;
    }

    /** Always valid
     *
     * @return bool
     */
    public function isValid () {
	return true;
    }
}
?>
