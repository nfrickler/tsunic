<!-- | CLASS Mail -->
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
	global $TSunic;
	return "SELECT _subject_ as subject,
		    _plaincontent_ as plaincontent,
		    _htmlcontent_ as htmlcontent,
		    fk_mailbox,
		    charset,
		    _sender_ as sender,
		    dateOfMail,
		    dateOfCreation,
		    dateOfUpdate,
		    uid,
		    unseen
		FROM #__mails
		WHERE id = '".$this->id."'
		    AND fk_account = '".$TSunic->Usr->getInfo('id')."'
		    AND dateOfDeletion = '0000-00-00 00:00:00'
	;";
    }

    /* get content of mail (prefer html)
     *
     * @return string/bool
     */
    public function getContent () {
	$content = $this->getHtmlContent();
	if (empty($content)) $content = $this->getPlainContent();
	return $content;
    }

    /* get plain content of mail
     *
     * @return string
     */
    public function getPlainContent () {
	global $TSunic;
	return $TSunic->Parser->toText(
	    base64_decode($this->getInfo('plaincontent'))
	);
    }

    /* get html content of mail
     *
     * @return string
     */
    public function getHtmlContent () {
	global $TSunic;
	return $TSunic->Parser->toHtml(
	    base64_decode($this->getInfo('htmlcontent'))
	);
    }

    /* get attachments of mail (as objects)
     *
     * @return array
     */
    public function getAttachments () {

	// already fetched?
	if (isset($this->attachments) AND !empty($this->attachments))
	    return $this->attachments;

	// get attachments from database
	global $TSunic;
	$sql = "SELECT fk_fsfile
		FROM #__attachments as attachments
		WHERE attachments.fk_mail = '".$this->id."'
		ORDER BY fk_fsfile ASC;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get FsFile objects
	$this->attachments = array();
	foreach ($result as $index => $values) {
	    $FsFile = $TSunic->get('$usersystem$FsFile', $values['fk_fsfile']);

	    // delete attachments with no more fsfile existing
	    if (!$FsFile->isValid()) {
		$this->rmAttachment($values['fk_fsfile']);
		continue;
	    }

	    $this->attachments[] = $FsFile;
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
	$FsFile = $TSunic->get('$usersystem$FsFile', $fk_fsfile);
	if (!$FsFile->isValid()) return false;

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
	global $TSunic;
	// TODO: remove files as well?

	// delete cached attachments
	$this->attachments = array();

	// update database
	$sql = "DELETE FROM #__attachments
		WHERE fk_fsfile = '$fk_fsfile'
		    AND fk_mail = '".$this->id."';";
	return $TSunic->Db->doDelete($sql);
    }

    /* remove all attachments from mail
     *
     * @return bool
     */
    public function rmAllAttachments () {
	global $TSunic;
	// TODO: remove files as well?

	// delete cached attachments
	$this->attachments = array();

	// update database
	$sql = "DELETE FROM #__attachments
		WHERE fk_mail = '".$this->id."';";
	return $TSunic->Db->doDelete($sql);
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

	// delete addressee
	$this->setAddressee('');

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
			fk_mailbox = '',
			charset = '',
			_sender_ = '',
			dateOfMail = '',
			dateOfCreation = '',
			dateOfDeletion = NOW()
		    WHERE id = '".$this->id."';";
	    $result = $TSunic->Db->doUpdate($sql);
	}

	if ($result) return true;
	return false;
    }

    /* create new mail
     * @param string: subject of mail
     * @param string: content of mail
     * @param string: e-mail address of addressee
     * @param int: fk_smtp
     *
     * @return bool
     */
    public function create ($subject, $content, $addressee, $fk_smtp = 0) {

	// validate input
	if (!$this->isValidSubject($subject)
	    or !$this->isValidContent($content)
	    or !$this->isValidAddressee($addressee)
	    or !$this->isValidFkSmtp($fk_smtp, false)
	) return false;

	// update database
	global $TSunic;
	$sql = "INSERT INTO #__mails
		SET _subject_ = '$subject',
		    _plaincontent_ = '".base64_encode($content)."',
		    fk_smtp = '$fk_smtp',
		    dateOfCreation = NOW(),
		    fk_account = '".$TSunic->Usr->getInfo('id')."'
	;";
	if (!$this->_create($sql)) return false;

	// set addressee
	if (!$this->setAddressee($addressee)) return false;

	return $this->id;
    }

    /* create from IMAP source
     * @param int: fk serverbox
     * @param int: fk mailbox
     * @param string: sender
     * @param string: addressee
     * @param string: date
     * @param string: plain content
     * @param string: html content
     * @param int: uid
     * @param bool: is mail unseen?
     * @param string: charset
     *
     * @return bool
     */
    public function createFromImap (
	$fk_serverbox, $fk_mailbox, $sender, $addressee, $date,
	$subject, $plaincontent, $htmlcontent, $uid, $unseen, $charset
    ) {
	global $TSunic;
	$Parser = $TSunic->get('$system$Parser');

	// save in database
	$sql = "INSERT INTO #__mails
		SET fk_account = '".$TSunic->Usr->getInfo('id')."',
		    fk_serverbox = '$fk_serverbox',
		    fk_mailbox = '$fk_mailbox',
		    _subject_ = '".$Parser->txt2db($subject)."',
		    _sender_ = '".$Parser->txt2db($sender)."',
		    dateOfCreation = NOW(),
		    status = '1',
		    unseen = '".($unseen ? '1' : '0')."',
		    dateOfMail = '".$Parser->txt2db($date)."',
		    uid = '".$Parser->txt2int($uid)."',
		    _plaincontent_ = '".base64_encode($Parser->txt2plain2db($plaincontent))."',
		    _htmlcontent_ = '".base64_encode($Parser->txt2db($htmlcontent))."',
		    charset = '".$Parser->txt2db($charset)."'
	";
	if (!$this->_create($sql)) return false;

	// set addressee
	if (!$this->setAddressee($addressee)) return false;

	return $this->id;
    }

    /* edit mail
     * @param string: subject of mail
     * @param string: content of mail
     * @param string: e-mail address of addressee
     * @param int: fk_smtp
     *
     * @return bool
     */
    public function edit ($subject, $content, $addressee, $fk_smtp = 0) {

	// validate input
	if (!$this->isValidSubject($subject)
	    or !$this->isValidContent($content)
	    or !$this->isValidAddressee($addressee)
	    or !$this->isValidFkSmtp($fk_smtp, false)
	) return false;

	// update database
	$sql = "UPDATE #__mails
		SET _subject_ = '$subject',
		    _plaincontent_ = '".base64_encode($content)."',
		    fk_smtp = '$fk_smtp',
		    dateOfUpdate = NOW()
		WHERE id = '".$this->id."'
	;";
	if (!$this->_edit($sql)) return false;

	// set addressee
	$result = $this->setAddressee($addressee);
	return ($result === false) ? false : true;
    }

    /* send mail
     *
     * @return bool
     */
    public function send () {
	if (!$this->isValid()) return false;
	global $TSunic;

	// get Smtp object
	$Smtp = $this->getSmtp();
	if (!$Smtp) return false;

	// send
	return $Smtp->send(
	    $this->getInfo('subject'),
	    $this->getContent(),
	    $this->getAddressee()
	);
    }

    /* set addressee
     * @param string: e-mail address of addressee
     *
     * @return bool
     */
    public function setAddressee ($addressee) {
	global $TSunic;

	// delete old ones
	$sql = "DELETE FROM #__addressees
		WHERE fk_mail = '".$this->id."'
		    AND NOT address = '$addressee';";
	if (!$TSunic->Db->doDelete($sql)) return false;

	// return, if $addresse empty
	if (empty($addressee)) return true;

	// add new ones
	$sql = "INSERT INTO #__addressees
		SET fk_mail = '".$this->id."',
		address = '$addressee'
		ON DUPLICATE KEY UPDATE dateOfUpdate = NOW()
	;";
	return ($TSunic->Db->doInsert($sql) === false) ? false : true;
    }

    /* get addressee
     *
     * @return bool/string
     */
    public function getAddressee () {
	global $TSunic;

	// get from database
	$sql = "SELECT address
		FROM #__addressees
		WHERE fk_mail = '".$this->id."';";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return false;

	return $result[0]['address'];
    }

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

    /* check, if fk_smtp is valid
     * @param int: fk_smtp of a mail
     *
     * @return bool
     */
    public function isValidFkSmtp ($fk_smtp, $required = true) {
	if (!$required and empty($fk_smtp)) return true;
	$Smtp = $this->getSmtp($fk_smtp);
	return $Smtp->isValid();
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

    /* check, if addressee is valid
     * @param int: addressee
     *
     * @return bool
     */
    public function isValidAddressee ($addressee) {
	return ($this->_validate($addressee, 'email')) ? true : false;
    }

    /* check, if mail is unseen
     *
     * @return bool
     */
    public function isUnseen () {
	return ($this->getInfo('unseen')) ? true : false;
    }

    /* unset unseen flag
     *
     * @return bool
     */
    public function setSeen () {
	global $TSunic;

	// update database
	$sql = "UPDATE #__mails
		SET unseen = 0
		WHERE id = '".$this->id."';";
	return $TSunic->Db->doUpdate($sql);
    }

    /* get Smtp object
     * +@param int: id of a Smtp object (default: fk_smtp)
     *
     * @return bool
     */
    public function getSmtp ($fk_smtp = false) {
	if ($fk_smtp === false and !$this->isValid()) return NULL;
	global $TSunic;

	// get fk_smtp
	if ($fk_smtp === false) $fk_smtp = $this->getInfo('fk_smtp');

	// get object
	$Smtp = $TSunic->get('$$$Smtp', $fk_smtp);
	if (!$Smtp->isValid()) {
	    $Smtp = $TSunic->get('$$$SmtpMail');
	    if (!$Smtp->isValid()) return NULL;
	}

	return $Smtp;
    }

    /* get Mailbox object
     *
     * @return bool
     */
    public function getMailbox () {
	if (!$this->isValid()) return NULL;
	global $TSunic;

	// get object
	$Mailbox= $TSunic->get('$$$Mailbox', $this->getInfo('fk_mailbox'));
	if (!$Mailbox->isValid()) {
	    $Mailbox = $TSunic->get('$$$Inbox');
	    if (!$Mailbox->isValid()) return NULL;
	}

	return $Mailbox;
    }
}
?>
