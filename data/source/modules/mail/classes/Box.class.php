<!-- | -->
<?php

class $$$Box {

	/* id of mailbox
	 * int
	 */
	private $id_mail__box;

	/* information about mailbox
	 * array
	 */
	private $info;

	/* mail-objects of mails in box
	 * array
	 */
	private $mails;

	/* constructor
	 * +@param int $id_mail__box: id_mail__box
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_mail__box = false) {

		// save id in obj-vars
		$this->id_mail__box = $id_mail__box;

		return;
	}

	/* get information about mailbox
	 * +@param string/bool $name: name of info (true will return $this->info)
	 *
	 * @return string/int/array
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if mailbox exists
		if (!$this->id_mail__box) return false;

		// check, if info already in obj-vars
		if (empty($this->info)) {

			// get infos from database
			$sql_0 = "SELECT _name_ as name,
							 _description_ as description,
							 dateOfCreation as dateOfCreation
					  FROM #__boxes
					  WHERE id_mail__box = '".mysql_real_escape_string($this->id_mail__box)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);
			$this->info = (!empty($result_0)) ? $result_0[0] : array() ;
			$this->info['id_mail__box'] = $this->id_mail__box;
		}

		// return requested info
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* update info-data
	 *
	 * @return true
 	 */
	protected function updateInfo () {

		// reset info
		$this->info = array();

		// get current info
		$this->getInfo();

		return true;
	}

	/* get object of mails in box
	 *
	 * @return array
 	 */
	public function getMails () {
		global $TSunic;

		// check, if mailbox exists
		if (!$this->id_mail__box) return false;

		// check, if info already in obj-vars
		if (!empty($this->mails)) return $this->mails;

		// get ids of mails
		$sql_0 = "SELECT mails.id_mail__mail as id_mail__mail
				  FROM #__mails as mails
				  WHERE mails.fk_mail__box = '".mysql_real_escape_string($this->id_mail__box)."'
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

	/* get number of mails in box
	 *
	 * @return int
 	 */
	public function getNumber () {

		// load mails
		$mails = $this->getMails();

		// get number
		if (empty($mails)) return 0;
		return count($mails);
	}

	/* create a new mailbox
	 * @param string $name: name of mailbox
	 * +@param string $description: description of box
	 *
	 * @return bool
 	 */
	public function createBox ($name, $description = '') {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name) OR !$this->isValidDescription($description)) return false;

		// save in db
		$sql_0 = "INSERT INTO #__boxes
				  SET fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."',
				  	  _name_ = '".mysql_real_escape_string($name)."',
				  	  _description_ = '".mysql_real_escape_string($description)."'
						";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->id_mail__box = mysql_insert_id();
		$this->updateInfo();

		return $result_0;
	}

	/* edit data of box
	 * @param string $name: name of mailbox
	 * @param string $description: description of box
	 *
	 * @return bool
 	 */
	public function editBox ($name, $description) {
		global $TSunic;

		// validate input
		if (!$this->isValidName($name) OR !$this->isValidDescription($description)) return false;

		// save new data in db
		$sql_0 = "UPDATE #__boxes
				  SET fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."',
				  	  _name_ = '".mysql_real_escape_string($name)."',
				  	  _description_ = '".mysql_real_escape_string($description)."'
				  WHERE id_mail__box = '".mysql_real_escape_string($this->id_mail__box)."';";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		return $result_0;
	}

	/* check, if name of box is valid
	 * @param string $name: name of mailbox
	 *
	 * @return bool
 	 */
	public function isValidName ($name) {

		// check, if name empty
		if (empty($name)) return false;

		return true;
	}

	/* check, if description of box is valid
	 * @param string $description: description of mailbox
	 *
	 * @return bool
 	 */
	public function isValidDescription ($description) {

		// TODO

		return true;
	}

	/* delete mailbox
	 *
	 * @return bool
 	 */
	public function deleteBox () {
		global $TSunic;

		// transfere all mails in inbox
		$mails = $this->getMails();
		foreach ($mails as $index => $Value) {
			if (!$Value->move(0)) return false;
		}

		// delete mailbox in database
		$sql_0 = "DELETE FROM #__boxes
				  WHERE id_mail__box = '".mysql_real_escape_string($this->id_mail__box)."';";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* get all serverboxes transfering mails into this box
	 *
	 * @return array
 	 */
	public function getServerboxes () {
		global $TSunic;

		// get serverboxes from database
		$sql_0 = "SELECT serverboxes.id_mail__serverbox as id_mail__serverbox
				  FROM #__serverboxes as serverboxes,
				  	   #__accounts as accounts
				  WHERE serverboxes.fk_mail__box = '".mysql_real_escape_string($this->getInfo('id_mail__box'))."'
				  		AND isActive = 1
				  		AND serverboxes.fk_mail__account = accounts.id_mail__account
				  		AND accounts.fk_system_users__account = '".mysql_real_escape_string($TSunic->CurrentUser->getInfo('id_system_users__account'))."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		if (!$result_0) return array();

		// get server-objects
		$all_objects = array();
		foreach ($result_0 as $index => $values) {

			// get objects
			$Serverbox = $TSunic->get('$$$Serverbox', $values['id_mail__serverbox']);

			// add to list
			$all_objects[] = $Serverbox;
		}

		return $all_objects;
	}

	/* get seconds until checking for new mails for this mailbox
	 *
	 * @return int
 	 */
	public function timeToCheck () {

		// get all serverboxes
		$serverboxes = $this->getServerboxes();

		$next = 1000;
		foreach ($serverboxes as $index => $Value) {
			$n = $Value->timeToCheck();
			if ($n < $next) $next = $n;
		}

		return $next;
	}

	/* check for new emails for this mailbox and store them in the database
	 * +@param bool $force: force check?
	 *
	 * @return array
 	 */
	public function checkMails ($force = false) {
		global $TSunic;

		// get serverboxes transfering mails in this mailbox
		$serverboxes = $this->getServerboxes();

		// check for new mails on each mailbox
		$all_new_mails = array();
		foreach ($serverboxes as $index => $value) {

			// check for new mails
			$return = $value->checkMails($force);

			// add new mails to output
			if (is_array($return))
				$all_new_mails = array_merge($all_new_mails, $return);
		}

		return $all_new_mails;
	}

	/* check, if mailserver exists
	 *
	 * @return bool
 	 */
	public function isValid () {

		// try to get host
		$name = $this->getInfo('name');

		if (!empty($name)) return true;
		return false;
	}
}
?>
