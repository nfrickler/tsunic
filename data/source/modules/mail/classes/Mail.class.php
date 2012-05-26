<!-- | mail class -->
<?php
include_once '$system$Object.class.php';
class $$$Mail extends $system$Object {

	/* attached files
	 * array of fsfile objects
	 */
	protected $attachments;

	/* load infos from database
	 *
	 * @return sql query
	 */
	protected function loadInfoSql () {
		return "SELECT mails._subject_ as subject,
				mails._plaincontent_ as plaincontent,
				mails._htmlcontent_ as htmlcontent,
				mails._addressee_ as addressee,
				mails.fk_mailbox as fk_mailbox,
				mails.charset as charset,
				mails._sender_ as sender,
				mails.dateOfMail as dateOfMail,
				mails.dateOfDownload as dateOfDownload
			FROM #__serverboxes as serverboxes,
				#__mails as mails
			WHERE mails.id = '".$this->id."'
				AND mails.fk_serverbox = serverboxes.id
				AND mails.dateOfDeletion = '0000-00-00 00:00:00'
			ORDER BY mails.id ASC;";
	}

	/* get plain content of mail
	 *
	 * @return string
	 */
	public function getPlainContent () {
		global $TSunic;
		return $TSunic->Parser->toText($this->info['plaincontent']);
	}

	/* get html content of mail
	 *
	 * @return string
	 */
	public function getHtmlContent () {
		global $TSunic;
		return $TSunic->Parser->toHtml($this->info['htmlcontent']);
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
			SET fk_fsfile = '$fk_fsfile',
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
			WHERE fk_fsfile = '$fk_fsfile',
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

	/* delete mail
	 * +@param bool: remove completely?
	 *
	 * @return bool
 	 */
	public function delete ($completely = false) {
		global $TSunic;

		// delete attachment
		$this->rmAllAttachments();

		// delete in database
		if ($completely) {
			$sql = "DELETE FROM #__mails
					WHERE id = '".$this->id."';";
			$result = $TSunic->Db->doDelete($sql);
		} else {
			$sql = "UPDATE #__mails
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
			$result = $TSunic->Db->doUpdate($sql);
		}

		if ($result) return true;
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
	 * @param int: $fk_mailbox
	 *
	 * @return bool
 	 */
	public function move ($fk_mailbox) {
		global $TSunic;

		// is valid mailbox?
		$Mailbox = $TSunic->get('$$$Mailbox', $fk_mailbox);
		if (!$Mailbox->isValid() AND !($fk_mailbox === 0)) return false;

		// update mail in database
		$sql = "UPDATE #__mails
			SET fk_mailbox = '$fk_mailbox'
			WHERE id = '".$this->id."'
		;";
		$result = $TSunic->Db->doInsert($sql);

		// update $this->info
		$this->getInfo(true, true);

		return ($return) ? true : false;
	}

	/* check, if sender is valid
	 * @param int: sender of a mail
	 *
	 * @return bool
 	 */
	public function isValidSender ($sender) {
		return ($this->_validate($sender, 'int')) ? true : false;
	}

	/* check, if subject is valid
	 * @param int: subject of a mail
	 *
	 * @return bool
 	 */
	public function isValidSubject ($subject) {
		return ($this->_validate($subject, 'extString')) ? true : false;
	}

	/* check, if content is valid
	 * @param int: content of mail
	 *
	 * @return bool
 	 */
	public function isValidContent ($content) {
		return (empty($content)) ? false : true;
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
