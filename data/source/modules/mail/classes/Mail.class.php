<!-- | mail class -->
<?php
class $$$Mail {

	/* id of e-mail
	 * int
	 */
	private $id_mail__mail;

	/* information about email
	 * array
	 */
	private $info;

	/* constructor
	 * @param int: id_ema of e-mail
	 */
	public function __construct ($id_mail__mail = false) {

		// save id in obj-vars
		$this->id_mail__mail = $id_mail__mail;

		return;
	}

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
			$sql_0 = "SELECT mails._subject_ as subject,
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
					WHERE mails.id_mail__mail = '".mysql_real_escape_string($this->id_mail__mail)."'
						AND mails.fk_mail__serverbox = serverboxes.id_mail__serverbox
						AND mails.dateOfDeletion = '0000-00-00 00:00:00'
					ORDER BY mails.id_mail__mail ASC;";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// save info in obj-vars
			$this->info = (isset($result_0, $result_0[0])) ? $result_0[0] : array();

			// parse content of mail
			$this->info['plaincontent'] = $TSunic->Parser->toText($this->info['plaincontent']);
			$this->info['htmlcontent'] = $TSunic->Parser->toHtml($this->info['htmlcontent']);
		}

		// add id to info
		$this->info['id_mail__mail'] = $this->id_mail__mail;

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
		global $TSunic;

		// already fetched?
		if (isset($this->attachments) AND !empty($this->attachments)) return $this->attachments;

		// get attachments from database
		$sql_1 = "SELECT id__attachment as id__attachment
				FROM #__attachments as attachments
				WHERE attachments.fk_mail__mail = '".mysql_real_escape_string($this->id_mail__mail)."'
				ORDER BY id__attachment ASC;";
		$result_1 = $TSunic->Db->doSelect($sql_1);

		// load userfiles as attachment
		$this->attachments = array();
		foreach ($result_1 as $index => $values) {
			// get userfile-object
			$this->attachments[] = $TSunic->get('$$$Attachment', $values['id__attachment']);
		}

		return $this->attachments;
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
		foreach ($this->getAttachments() as $index => $Value) {
			// delete attachment
			$Value->deleteAttachment();
		}

		// delete in database
		if ($completely) {
			$sql_0 = "DELETE FROM #__mails
					WHERE id_mail__mail = '".mysql_real_escape_string($this->id_mail__mail)."';";
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
					WHERE id_mail__mail = '".mysql_real_escape_string($this->id_mail__mail)."';";
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
				SET fk_mail__box = '".mysql_real_escape_string($fk_mail__box)."'
				WHERE id_mail__mail = '".mysql_real_escape_string($this->id_mail__mail)."'
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
