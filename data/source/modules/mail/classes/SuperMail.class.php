<!-- | class handling general mail things -->
<?php
class $$$SuperMail {

	/* mailbox objects
	 * array
	 */
	protected $mailboxes;

	/* smtp objects
	 * array
	 */
	protected $smtps;

	/* mailaccount objects
	 * array
	 */
	protected $mailaccounts;

	/* get all mailaccount-objects of user-account
	 *
	 * @return array
	 */
	public function getMailaccounts () {

		// check, if mailaccounts allready loaded
		if (!empty($this->mailaccounts)) return $this->mailaccounts;

		// get server-info from databbase
		global $TSunic;
		$sql = "SELECT id
			FROM #__mailaccounts
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

	/* get all mailbox-objects of account
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
			FROM #__mailboxes
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

	/* get all smtp-objects of user-account
	 * +@param bool: include local sender (if enabled)?
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
			FROM #__smtps
			WHERE fk_account = '".$TSunic->Usr->getInfo('id')."'
		";
		$result = $TSunic->Db->doSelect($sql);
		if ($result === false) return array();

		// add localSender, if enabled
		if ($includeLocal AND $TSunic->Config->getConfig('email_enabled') === true) {
			$this->smtps[] = $TSunic->get('$$$SenderLocal');
		}

		// get smtp-objects and save them in obj-var
		foreach ($result as $index => $value) {
			$this->smtps[] = $TSunic->get('$$$Smtp', $value['id']);
		}

		return $this->smtps;
	}
}
?>
