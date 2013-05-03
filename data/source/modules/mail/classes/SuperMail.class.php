<!-- | CLASS SuperMail -->
<?php
/** Meta class of mail module
 *
 * This meta class offers some helper methods
 */
class $$$SuperMail {

    /** Mailbox objects
     * @var array $mailboxes
     */
    protected $mailboxes;

    /** Smtp objects
     * @var array $smtps
     */
    protected $smtps;

    /** Mailaccount objects
     * @var array $mailaccounts
     */
    protected $mailaccounts;

    /** Get all mailaccount objects of user account
     *
     * @return array
     */
    public function getMailaccounts () {

	// check, if mailaccounts allready loaded
	if (!empty($this->mailaccounts)) return $this->mailaccounts;

	// get server-info from databbase
	global $TSunic;
	$sql = "SELECT id
	    FROM #__$mail$mailaccounts
	    WHERE fk_account = '".$TSunic->Usr->getInfo('id')."';";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return array();

	// get server-objects
	$this->mailaccounts = array();
	foreach ($result as $index => $values) {
	    $the_account = $TSunic->get('$$$Mailaccount', $values['id']);
	    if ($the_account) $this->mailaccounts[] = $the_account;
	}

	return $this->mailaccounts;
    }

    /** Get all mailbox objects of account
     *
     * @return array
     */
    public function getMailboxes () {

	// check, if servers allready loaded
	if (!empty($this->mailboxes)) return $this->mailboxes;

	// get id_acc
	global $TSunic;
	$id_acc = $TSunic->Usr->getInfo('id');

	// get server-info from databbase
	$sql = "SELECT id
	    FROM #__$mail$mailboxes
	    WHERE fk_account = '$id_acc'
	    ORDER BY id ASC;";
	$result = $TSunic->Db->doSelect($sql);

	// get empty array
	$this->mailboxes = array();

	// add inbox to boxes
	$Inbox = $TSunic->get('$$$Inbox');
	$this->mailboxes[] = $Inbox;

	// get mailbox-objects
	foreach ($result as $index => $values) {
	    $the_mailbox = $TSunic->get('$$$Mailbox', $values['id']);
	    if ($the_mailbox) $this->mailboxes[] = $the_mailbox;
	}

	return $this->mailboxes;
    }

    /** Get Smtp with specified id (including 0 for SmtpLocal)
     * @param int $id
     *	Id of Smtp object
     *
     * @return Smtp
     */
    public function getSmtp ($id) {
	$smtps = $this->getSmtps(true);
	foreach ($smtps as $index => $Value) {
	    if ($Value->getInfo('id') == $id) return $Value;
	}
	return NULL;
    }

    /** Get all Smtp objects of user account
     * @param bool $includeLocal
     *	Include local sender (if enabled)?
     *
     * @return array
     */
    public function getSmtps ($includeLocal = false) {

	// check, if already in cache
	if (isset($this->smtps) AND !empty($this->smtps)) return $this->smtps;
	$this->smtps = array();

	// get all smtps from database
	global $TSunic;
	$sql = "SELECT id
	    FROM #__$mail$smtps
	    WHERE fk_account = '".$TSunic->Usr->getInfo('id')."'
	";
	$result = $TSunic->Db->doSelect($sql);
	if ($result === false) return array();

	// add localSender, if enabled
	if ($includeLocal) {
	    $this->smtps[] = $TSunic->get('$$$SmtpLocal');
	}

	// get smtp-objects and save them in obj-var
	foreach ($result as $index => $value) {
	    $this->smtps[] = $TSunic->get('$$$Smtp', $value['id']);
	}

	return $this->smtps;
    }
}
?>
