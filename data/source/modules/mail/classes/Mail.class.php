<!-- | CLASS Mail -->
<?php
class $$$Mail extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'MAIL__SUBJECT',
	'MAIL__SENDER',
	'MAIL__TIMESTAMP',
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
	$Serverbox = $TSunic->get('$$$Serverbox', $this->getInfo('serverbox'));
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

	// delete on server
	$Serverbox = $this->getServerbox();
	if ($delonserver and $Serverbox) {
	    $mailbox = $this->getServerbox()->getInfo('name');
	    $Server = $Serverbox->getMailaccount()->getServer();

	    if (!$Server or !$Server->deleteMail($mailbox,$this->getInfo('uid'), $cleanup))
		return false;
	}

	// delete mail locally
	return parent::delete();
    }

    // ####################### attachments ##################################

    /* get attachments of mail (as objects)
     *
     * @return array
     */
    public function getAttachments () {
	if (!empty($this->attachments)) return $this->attachments;
	global $TSunic;

	// get all attachments
	$bits = $this->getByTag('MAIL__ATTACHMENT');

	// get objects
	$this->attachments = array();
	foreach ($bits as $index => $Value) {
	    $File = $TSunic->get(
		'$filesystem$File', $Value->getInfo('value')
	    );
	    if (!$File->isValid()) {
		$Value->delete();
		continue;
	    }
	    $this->attachments[] = $File;
	}

	return $this->attachments;
    }

    /* add new attachment
     * @param string: name of file
     * @param string: content of file
     *
     * @return bool
     */
    public function addAttachment ($name, $content) {
	global $TSunic;

	// get File object
	$File = $TSunic->get('$filesystem$File', false, true);

	// get ".mail" directory
	$Dir = $File->path2dir('.mail');

	// create new file
	if (!$File or !$File->createByValues($Dir->getInfo('id'), $name, $content))
	    return false;

	return $this->addBit($File->getInfo('id'), 'MAIL__ATTACHMENT');
    }
}
?>
