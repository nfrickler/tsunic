<!-- | CLASS Mail -->
<?php
/** Mail class
 *
 * This class offeres Mails. These mails can either be created locally or
 * synchronized with a Serverbox.
 */
class $$$Mail extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
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
	'MAIL__BOX',
	'MAIL__UID',
	'MAIL__UNSEEN',
    );

    /** Get content of mail (prefer html)
     * @param string $type
     *	Type of content (plain or html)
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

    /** Get plain content of mail
     *
     * @return string
     */
    public function getPlainContent () {
	return $this->getContent('plain');
    }

    /** Get html content of mail
     *
     * @return string
     */
    public function getHtmlContent () {
	return $this->getContent('html');
    }

    /** Send mail
     *
     * @return bool
     */
    public function send () {
	if (!$this->isValid()) return false;
	global $TSunic;

	// update date
//	$this->saveByTag('MAIL__TIMESTAMP', time());

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

    /** Move mail to mailbox
     * @param int $fk_mailbox
     *	Fk_mailbox
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

    /** Check, if sender is valid
     * @param int $sender
     *	Sender of a mail
     *
     * @return bool
     */
    public function isValidSender($sender) {
	return ($this->getSmtp($sender)) ? true : false;
    }

    /** Check, if content is valid
     * @param string $content
     *	Content of mail
     *
     * @return bool
     */
    public function isValidContent ($content) {
	return (empty($content)) ? false : true;
    }

    /** Check, if addressee is valid
     * @param string $addressee
     *	Addressee
     *
     * @return bool
     */
    public function isValidAddressee ($addressee) {
	return ($this->_validate($addressee, 'email')) ? true : false;
    }

    /** Check, if mail is unseen
     *
     * @return bool
     */
    public function isUnseen () {
	return ($this->getInfo('unseen')) ? true : false;
    }

    /** Unset unseen flag
     *
     * @return bool
     */
    public function setSeen () {
	return $this->saveByTag('MAIL__UNSEEN', 1);
    }

    /** Get Smtp object of this Mail
     *
     * @return Smtp
     */
    public function getSmtp () {
	global $TSunic;
	$Meta = $TSunic->get('$$$SuperMail');
	return $Meta->getSmtp($this->getInfo('sender'));
    }

    /** Get Mailbox object
     *
     * @return Mailbox
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

    /** Get Serverbox object
     *
     * @return Serverbox
     */
    public function getServerbox () {
	if (!$this->isValid()) return NULL;
	global $TSunic;

	// get object
	$Serverbox = $TSunic->get('$$$Serverbox', $this->getInfo('serverbox'));
	if (!$Serverbox->isValid()) return NULL;

	return $Serverbox;
    }

    /** Delete mail
     * @param bool $delonserver
     *	Delete mail on server?
     * @param bool $cleanup
     *	Remove from server completely (not only mark as deleted)?
     *
     * @return bool
     */
    public function delete ($delonserver = true, $cleanup = true) {

	// delete attachments of this mail in .mail directory
	$Dir = $this->getAttachmentDir();
	$attachments = $this->getAttachments();
	foreach ($attachments as $index => $Value) {
	    if ($Value->getInfo('parent') == $Dir->getInfo('id')) {
		// delete File
		if (!$Value->delete()) return false;
	    }
	}

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

    /** Get attachment directory
     *
     * @return Directory
     */
    public function getAttachmentDir () {
	global $TSunic;
	$Filesystem = $TSunic->get('$filesystem$Filesystem');
	return $Filesystem->path2dir('.mail');
    }

    // ####################### attachments ##################################

    /** Get attachments of mail (as objects)
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

    /** Add new attachment
     * @param string $name
     *	Name of file
     * @param string $content
     *	Content of file
     *
     * @return bool
     */
    public function addAttachment ($name, $content) {
	global $TSunic;

	// get File object
	$File = $TSunic->get('$filesystem$File', false, true);

	// get ".mail" directory
	$Dir = $this->getAttachmentDir();

	// create new file
	if (!$File or !$File->createByValues($Dir->getInfo('id'), $name, $content))
	    return false;

	return $this->addBit($File->getInfo('id'), 'MAIL__ATTACHMENT');
    }
}
?>
