<!-- | mail class -->
<?php
include_once '$system$Object.class.php';
class $$$Mail extends $system$Object {

	/* attached files
	 * array of fsfile objects
	 */
	protected $attachments;

	/* get all data of e-mail
	 * +@param bool/string: name of data (true will return all data)
	 *
	 * @return array/false
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if mail exists
		if (empty($this->id_mail__mail)) return false;

		// check, if content already in cache
		if (empty($this->info)) {
			$this->info = array();

			// get content from database
			$sql = "SELECT mails._subject_ as subject,
					mails._plaincontent_ as plaincontent,
					mails._htmlcontent_ as htmlcontent,
					mails._addressee_ as addressee,
					mails.fk_mail__box as fk_mail__box,
					mails.charset as charset,
					mails._sender_ as sender,
					mails.dateOfMail as dateOfMail,
					mails.dateOfDownload as dateOfDownload
				FROM #__serverboxes as serverboxes,
					#__mails as mails
				WHERE mails.id = '".$this->id."'
					AND mails.fk_mail__serverbox = serverboxes.id
					AND mails.dateOfDeletion = '0000-00-00 00:00:00'
				ORDER BY mails.id ASC;";
			$result = $TSunic->Db->doSelect($sql);

			// save info in obj-vars
			$this->info = (isset($result, $result[0])) ? $result[0] : array();

			// parse content of mail
			$this->info['plaincontent'] = $TSunic->Parser->toText($this->info['plaincontent']);
			$this->info['htmlcontent'] = $TSunic->Parser->toHtml($this->info['htmlcontent']);
		}

		// add id to info
		$this->info['id'] = $this->id;

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* get attachments of mail (as objects)
	 *
	 * @return array
	 */
	public function getAttachments () {

		// already fetched?
		if (isset($this->attachments) AND !empty($this->attachments)) return $this->attachments;

		// get attachments from database
		global $TSunic;
		$sql = "SELECT fk_fsfile
			FROM #__attachments as attachments
			WHERE attachments.fk_mail = '".$this->id."'
			ORDER BY fk_fsfile ASC;";
		$result = $TSunic->Db->doSelect($sql);
		if (!$result) return array();

		// get fsfile objects
		$this->attachments = array();
		foreach ($result as $index => $values) {
			$this->attachments[] = $TSunic->get('$usersystem$FsFile', $values['fk_fsfile']);
		}

		return $this->attachments;
	}

	/* add attachment to mail
	 * @param int: fk of fsfile
	 *
	 * @return bool
	 */
	public function addAttachment ($fk_fsfile) {
		global $TSunic;

		// validate fsfile
		if (!$this->_isObject('$system$FsFile', $fk_fsfile)) return false;

		// delete cached attachments
		$this->attachments = array();

		// update database
		$sql = "INSERT INTO #__attachments
			SET fk_fsfile = '".$fk_fsfile."',
				fk_mail = '".$this->id."'
			ON DUPLICATE KEY UPDATE dateOfUpdate = NOW();";
		return $TSunic->Db->doInsert($sql);
	}

	/* remove attachment from mail
	 * @param int: fk of fsfile
	 *
	 * @return bool
	 */
	public function rmAttachment ($fk_fsfile) {
		// TODO: remove files as well?

		// delete cached attachments
		$this->attachments = array();

		// update database
		$sql = "DELETE FROM #__attachments
			WHERE fk_fsfile = '".$fk_fsfile."',
				fk_mail = '".$this->id."';";
		return $TSunic->Db->doDelete($sql);
	}

	/* remove all attachments from mail
	 *
	 * @return bool
	 */
	public function rmAllAttachments () {
		// TODO: remove files as well?

		// delete cached attachments
		$this->attachments = array();

		// update database
		$sql = "DELETE FROM #__attachments
			WHERE fk_mail = '".$this->id."';";
		return $TSunic->Db->doDelete($sql);
	}

	/* get content of mail
	 *
	 * @return string/bool
 	 */
	public function getContent () {

		// try to get html-content
		$content = $this->getInfo('htmlcontent');
		if (!empty($content)) return $content;

		// try to get plaintext-content instead
		$content = $this->getInfo('plaincontent');
		if (!empty($content)) return $content;

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

	/* delete e-mail in database
	 * +@param bool: remove completely?
	 *
	 * @return bool
 	 */
	public function deleteMail ($completely = false) {
		global $TSunic;

		// delete attachment
		$this->rmAllAttachments();

		// delete in database
		if ($completely) {
			$sql_0 = "DELETE FROM #__mails
					WHERE id = '".$this->id."';";
			$result_0 = $TSunic->Db->doDelete($sql_0);
		} else {
			$sql_0 = "UPDATE #__mails
					SET _subject_ = '',
						_plaincontent_ = '',
						_htmlcontent_ = '',
						_addressee_ = '',
						fk_mail__box = '',
						charset = '',
						_sender_ = '',
						dateOfMail = '',
						dateOfDownload = '',
						dateOfDeletion = NOW()
					WHERE id = '".$this->id."';";
			$result_0 = $TSunic->Db->doUpdate($sql_0);
		}

		if ($result_0) return true;
		return false;
	}

	/* send mails (local only)
	 * @param int: accountID of addressee
	 * @param int: fk_mail__server (0 - local)
	 * @param string: subject of mail
	 * @param string: content of mail
	 *
	 * @return bool
	 */
	 /*
	public function createMail ($addressee, $sender, $subject, $content) {
		global $TSunic;

		// validate input
		if (!$this->isValidSender($sender)
				OR !$this->isValidSubject($subject)
				OR !$this->isValidContent($content)) {
			// invalid input
			return false;
		}

		// insert mail in database
		$sql_0 = "INSERT INTO #__mails
				  SET _subject_ = '".mysql_real_escape_string($subject)."',
				  	  _content_ = '".mysql_real_escape_string($content)."',
				  	  sender = '".mysql_real_escape_string($sender)."',
				  	  addressee '".mysql_real_escape_string($addressee)."'
				  ;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->id_mail__mail = mysql_insert_id();
		$this->updateInfo();

		if (!$result_0) return false;
		return true;
	}
*/

	/* move mail to mailbox
	 * @param int: $fk_mail__box
	 *
	 * @return bool
 	 */
	public function move ($fk_mail__box) {
		global $TSunic;
		$fk_mail__box = (int) $fk_mail__box;

		// is valid mailbox?
		$Mailbox = $TSunic->get('$$$Box', $fk_mail__box);
		if (!$Mailbox->isValid() AND !($fk_mail__box === 0)) {
			return false;
		}

		// update mail in database
		$sql_0 = "UPDATE #__mails
				SET fk_mail__box = '".$fk_mail__box."'
				WHERE id = '".$this->id."'
				  ;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->updateInfo();

		if (!$result_0) return false;
		return true;
	}

	/* check, if sender is valid
	 * @param int: sender of a mail
	 *
	 * @return bool
 	 */
	public function isValidSender ($sender) {

		// check, if valid number
		if (!is_numeric($sender)) return false;

		return true;
	}

	/* check, if subject is valid
	 * @param int: subject of a mail
	 *
	 * @return bool
 	 */
	public function isValidSubject ($subject) {

		// check, if exist
		if (empty($sender)) return false;

		return true;
	}

	/* check, if content is valid
	 * @param int: content of a mail
	 *
	 * @return bool
 	 */
	public function isValidContent ($content) {

		// check, if exist
		if (empty($content)) return false;

		return true;
	}

	/* download e-mail
	 *
	 * @return bool
 	 */
	public function download () {
		global $TSunic;

		// TODO

		return $return;
	}

	/* check, if mail is unseen
	 *
	 * @return bool
 	 */
	public function isUnseen () {
		global $TSunic;

		// TODO

		return true;
	}
}
?>
