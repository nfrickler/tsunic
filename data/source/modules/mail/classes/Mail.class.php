<!-- | CLASS Mail -->
<?php
class $$$Mail extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'MAIL__SUBJECT',
	'MAIL__SENDER',
	'MAIL__ADDRESSEE',
	'MAIL__ATTACHMENT',
	'MAIL__HTMLCONTENT',
	'MAIL__PLAINCONTENT',
	'MAIL__SERVERBOX',
	'MAIL__BOX',
	'MAIL__MAILBOX',
	'MAIL__CHARSET',
	'MAIL__UID',
	'MAIL__UNSEEN',
    );

    /* get content of mail (prefer html)
     * +@param string: type of content (plain or html)
     *
     * @return string
     */
    public function getContent ($type = 'plain') {
	global $TSunic;
	$Parser = $TSunic->get('$system$Parser');

	// return parsed content
	$htmlcontent = $this->getInfo('htmlcontent');
	if ($type == 'plain' or empty($htmlcontent)) {
	    return $Parser->toText($this->getInfo('plaincontent'));
	} else {
	    return $Parser->toHtml($htmlcontent);
	}
    }

    /* get plain content of mail
     *
     * @return string
     */
    public function getPlainContent () {
	return $this->getContent('plain');
    }

    /* get html content of mail
     *
     * @return string
     */
    public function getHtmlContent () {
	return $this->getContent('html');
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
	$data = array(
	    "fk_account" => $TSunic->Usr->getInfo('id'),
	    "fk_serverbox" => $fk_serverbox,
	    "fk_mailbox" => $fk_mailbox,
	    "subject" => $Parser->text2db($subject),
	    "sender" => $Parser->text2db($sender),
	    "dateOfCreation" => "NOW()",
	    "status" => 1,
	    "unseen" => ($unseen ? 1 : 0),
	    "dateOfMail" => $Parser->text2db($date),
	    "uid" => $Parser->text2int($uid),
	    "plaincontent" => $Parser->text2plain2db($plaincontent),
	    "htmlcontent" => $Parser->text2db($htmlcontent),
	    "charset" => $Parser->text2db($charset)
	);
	if (!$this->_create($data)) return false;

	// set addressee
	if (!$this->setAddressee($addressee)) return false;

	return $this->id;
    }

    /* send mail
     *
     * @return bool
     */
    public function send () {
	if (!$this->isValid()) return false;
	global $TSunic;

	// update date
	$this->saveByTag('MAIL__DATE', date('Y-m-d H:i:s'));

	// get Smtp object
	$Smtp = $this->getSmtp();
	if (!$Smtp) return false;

	// send to all addressees
	$errors = 0;
	$addressees = $this->getByTag('MAIL__ADDRESSEE');
	foreach ($addressees as $index => $Value) {
	    if (!$Smtp->send($this, $Value->getInfo('value'))) {
		$errors++;
	    }
	}

	return ($errors) ? false : true;
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

	// update Bit
	return $this->saveByTag('MAIL__BOX', $fk_mailbox);
    }

    /* check, if sender is valid
     * @param int: sender of a mail
     *
     * @return bool
     */
    public function isValidSender($sender) {
	return ($this->getSmtp($sender)) ? true : false;
    }

    /* check, if content is valid
     * @param string: content of mail
     *
     * @return bool
     */
    public function isValidContent ($content) {
	return (empty($content)) ? false : true;
    }

    /* check, if addressee is valid
     * @param string: addressee
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
	return $this->saveByTag('MAIL__SEEN', 0);
    }

    /* get Smtp object of this Mail
     *
     * @return object
     */
    public function getSmtp () {
	global $TSunic;
	$Meta = $TSunic->get('$$$SuperMail');
	return $Meta->getSmtp($this->getInfo('sender'));
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

    /* get Serverbox object
     *
     * @return bool
     */
    public function getServerbox () {
	if (!$this->isValid()) return NULL;
	global $TSunic;

	// get object
	$Serverbox = $TSunic->get('$$$Serverbox', $this->getInfo('fk_serverbox'));
	if (!$Serverbox->isValid()) return NULL;

	return $Serverbox;
    }

    /* delete mail
     * +@param bool: delete mail on server?
     * +@param bool: remove from server completely (not only mark as deleted)?
     *
     * @return bool
     */
    public function delete ($delonserver = true, $cleanup = true) {
	global $TSunic;

	// delete on server
	$Serverbox = $this->getServerbox();
	if ($delonserver and $Serverbox) {
	    $mailbox = $this->getServerbox()->getInfo('name');
	    $Server = $Serverbox->getMailaccount()->getServer();

	    if (!$Server or !$Server->deleteMail($mailbox,$this->getInfo('uid'), $cleanup))
		return false;
	}

	// delete mail locally
	return $this->_delete();
    }

    // ####################### attachments ##################################

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
		FROM #__$mail$attachments as attachments
		WHERE attachments.fk_mail = '".$this->id."'
		ORDER BY fk_fsfile ASC;";
	$result = $TSunic->Db->doSelect($sql);
	if (!$result) return array();

	// get FsFile objects
	$this->attachments = array();
	foreach ($result as $index => $values) {
	    $FsFile = $TSunic->get('$filesystem$FsFile', $values['fk_fsfile']);

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
	$FsFile = $TSunic->get('$filesystem$FsFile', $fk_fsfile);
	if (!$FsFile->isValid()) return false;

	// delete cached attachments
	$this->attachments = array();

	// update database
	$sql = "INSERT INTO #__$mail$attachments
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
	$sql = "DELETE FROM #__$mail$attachments
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
	$sql = "DELETE FROM #__$mail$attachments
		WHERE fk_mail = '".$this->id."';";
	return $TSunic->Db->doDelete($sql);
    }
}
?>
