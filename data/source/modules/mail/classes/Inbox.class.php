<!-- | Inbox class -->
<?php
include_once '$$$Box.class.php';
class $$$Inbox extends $$$Box {

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
				'id_mail__box' => 0
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
		$sql_0 = "SELECT mails.id_mail__mail as id_mail__mail
				FROM #__mails as mails,
					#__serverboxes as serverboxes,
					#__accounts as accounts
				WHERE accounts.fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."'
					AND serverboxes.fk_mail__account = accounts.id_mail__account
					AND mails.fk_mail__serverbox = serverboxes.id_mail__serverbox
					AND mails.fk_mail__box = '0'
					AND mails.dateOfDeletion = '0000-00-00 00:00:00';";
		$ids_mails = $TSunic->Db->doSelect($sql_0);

		// create and store objects
		$this->mails = array();
		foreach ($ids_mails as $index => $value) {
			// get mail-object
			$this->mails[] = $TSunic->get('$$$Mail', array($value['id_mail__mail']));
		}

		return $this->mails;
	}

	/* create a new mailbox
	 * @param string: name of mailbox
	 * +@param string: description of box
	 *
	 * @return bool
	 */
	public function createBox ($name, $description = '') {
		return false;
	}

	/* edit data of box
	 * @param string: name of mailbox
	 * @param string: description of box
	 *
	 * @return bool
	 */
	public function editBox ($name, $description) {
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
	public function deleteBox () {
		return false;
	}
}
?>
