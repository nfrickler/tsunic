<!-- | mailbox class -->
<?php
include_once '$system$Object.class.php';
class $$$Box extends $system$Object {

	/* mail-objects of mails in box
	 * array
	 */
	private $mails;

	/* load infos from database
	 *
	 * @return sql query
	 */
	protected function loadInfoSql () {
		return "SELECT _name_,
				_description_,
				dateOfCreation,
				dateOfUpdate
			FROM #__boxes
			WHERE id = '$this->id';";
	}

	/* get object of mails in box
	 *
	 * @return array
 	 */
	public function getMails () {
		global $TSunic;

		// check, if mailbox exists
		if (!$this->id) return false;

		// check, if info already in obj-vars
		if (!empty($this->mails)) return $this->mails;

		// get ids of mails
		$sql = "SELECT mails.id as id
			FROM #__mails
			WHERE mails.fk_mail__box = '".$this->id."'
				AND mails.dateOfDeletion = '0000-00-00 00:00:00';";
		$result = $TSunic->Db->doSelect($sql);
		if (!$result) return array();

		// create and store objects
		$this->mails = array();
		foreach ($result as $index => $value) {
			$this->mails[] = $TSunic->get('$$$Mail', array($value['id']));
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

		// return number
		return ($mails) ? count($mails) : 0;
	}

	/* create a new mailbox
	 * @param string: name of mailbox
	 * +@param string: description of box
	 *
	 * @return bool
 	 */
	public function createBox ($name, $description = '') {

		// validate input
		if (!$this->isValidName($name)
			OR !$this->isValidDescription($description)
		) return false;

		// save in db
		global $TSunic;
		$sql = "INSERT INTO #__boxes
			SET fk_system_users__account = '".$TSunic->Usr->getInfo('id')."',
				_name_ = '".$name."',
				_description_ = '".$description."'
			";
		return $this->_create($sql);
	}

	/* edit data of box
	 * @param string: name of mailbox
	 * +@param string: description of box
	 *
	 * @return bool
 	 */
	public function editBox ($name, $description = '') {

		// validate input
		if (!$this->isValidName($name)
			OR !$this->isValidDescription($description)
		) return false;

		// save new data in db
		global $TSunic;
		$sql = "UPDATE #__boxes
			SET fk_system_users__account = '".$TSunic->Usr->getInfo('id')."',
				_name_ = '".$name."',
				_description_ = '".$description."'
			WHERE id = '".$this->id."';";
		return $this->_edit($sql);
	}

	/* check, if name of box is valid
	 * @param string: name of mailbox
	 *
	 * @return bool
	 */
	public function isValidName ($name) {
		return ($this->_validate($name, 'string')) ? true : false;
	}

	/* check, if description of box is valid
	 * @param string: description of mailbox
	 *
	 * @return bool
	 */
	public function isValidDescription ($description) {
		return (empty($description)
			or $this->_validate($name, 'string')
		) ? true : false;
	}

	/* delete mailbox
	 *
	 * @return bool
	 */
	public function deleteBox () {

		// transfere all mails in inbox
		$mails = $this->getMails();
		foreach ($mails as $index => $Value) {
			if (!$Value->move(0)) return false;
		}

		// delete mailbox in database
		$sql = "DELETE FROM #__boxes
			WHERE id = '".$this->id."';";
		return $this->_delete($sql);
	}

	/* get all serverboxes transfering mails into this box
	 *
	 * @return array
 	 */
	public function getServerboxes () {
		global $TSunic;

		// get serverboxes from database
		$sql = "SELECT serverboxes.id as id
			FROM #__serverboxes as serverboxes,
				#__accounts as accounts
			WHERE serverboxes.fk_mail__box = '".$this->getInfo('id')."'
				AND isActive = 1
				AND serverboxes.fk_mail__account = accounts.id
				AND accounts.fk_system_users__account = '".$TSunic->Usr->getInfo('id')."';";
		$result = $TSunic->Db->doSelect($sql);
		if (!$result) return array();

		// get server-objects
		$all_objects = array();
		foreach ($result as $index => $values) {
			$all_objects[] = $TSunic->get('$$$Serverbox', $values['id']);
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
}
?>
