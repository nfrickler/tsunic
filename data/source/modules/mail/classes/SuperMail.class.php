<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			classes/SuperMail.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$SuperMail {

	/* mailbox-objects
	 * array
	 */
	private $mailboxes;

	/* smtp-objects
	 * array
	 */
	private $smtps;

	/* mailaccount-objects
	 * array
	 */
	private $mailaccounts;

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		return;
	}

	/* get all mailaccount-objects of user-account
	 *
	 * @return array
 	 */
	public function getMailaccounts () {
		global $TSunic;

		// check, if mailaccounts allready loaded
		if (!empty($this->mailaccounts)) return $this->mailaccounts;

		// get server-info from databbase
		$sql_0 = "SELECT id_mail__account as id_mail__account
				  FROM #__accounts
				  WHERE fk_system_users__account = '".$TSunic->CurrentUser->getInfo('id_system_users__account')."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);
		if ($result_0 === false) return array();

		// get server-objects
		$this->mailaccounts = array();
		foreach ($result_0 as $index => $values) {

			// get new object
			$the_account = $TSunic->get('$$$Account', $values['id_mail__account']);
			if ($the_account) $this->mailaccounts[] = $the_account;
		}

		return $this->mailaccounts;
	}

	/* get all mailbox-objects of account
	 *
	 * @return array
 	 */
	public function getMailboxes () {
		global $TSunic;

		// check, if servers allready loaded
		if (!empty($this->mailboxes)) return $this->mailboxes;

		// get id_acc
		$id_acc = $TSunic->CurrentUser->getInfo('id_system_users__account');

		// get server-info from databbase
		$sql_0 = "SELECT id_mail__box as id_mail__box
				  FROM #__boxes
				  WHERE fk_system_users__account = '".$id_acc."'
				  ORDER BY id_mail__box ASC;";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// get empty array
		$this->mailboxes = array();

		// add inbox to boxes
		$Inbox = $TSunic->get('$$$Inbox');
		$this->mailboxes[] = $Inbox;

		// get mailbox-objects
		foreach ($result_0 as $index => $values) {

			// get new object
			$the_mailbox = $TSunic->get('$$$Box', $values['id_mail__box']);
			if ($the_mailbox) $this->mailboxes[] = $the_mailbox;
		}

		return $this->mailboxes;
	}

	/* get all smtp-objects of user-account
	 * +@param bool $includeLocal: include local sender (if enabled)?
	 *
	 * @return array
 	 */
	public function getSmtps ($includeLocal = false) {
		global $TSunic;

		// check, if already in cache
		if (isset($this->smtps) AND !empty($this->smtps)) return $this->smtps;
		$this->smtps = array();

		// get all smtps from database
		$sql_0 = "SELECT id_mail__smtp as id_mail__smtp
				  FROM #__smtps
				  WHERE fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."'
				  ";
		$result_0 = $TSunic->Db->doSelect($sql_0);
		if ($result_0 === false) return array();

		// add localSender, if enabled
		if ($includeLocal AND $TSunic->Config->getConfig('email_enabled') === true) {
			$this->smtps[] = $TSunic->get('$$$SenderLocal');
		}

		// get smtp-objects and save them in obj-var
		foreach ($result_0 as $index => $value) {
			// get object
			$this->smtps[] = $TSunic->get('$$$Smtp', $value['id_mail__smtp']);
		}

		// return
		return $this->smtps;
	}
}
?>