<!-- | CLASS Serverbox -->
<?php
/** Mapping of external Serverbox to TSunic Mailbox
 *
 * This class connects a mailbox of an external mailaccount to TSunics
 * object system
 */
class $$$Serverbox extends $system$Object {

    /** Tablename in database
     * @var string $table
     */
    protected $table = "#__$mail$serverboxes";

    /** Mailaccount object
     * @var Mailaccount $Mailaccount
     */
    protected $Mailaccount;

    /** Mailbox object
     * @var Mailbox $Mailbox
     */
    protected $Mailbox;

    /** Temporary cache
     * @var array $cache
     */
    protected $cache;

    /** Get corresponding Mailbox object
     *
     * @return Mailbox
     */
    public function getMailbox () {
	if ($this->Mailbox) return $this->Mailbox;
	global $TSunic;

	// get fk_maibox
	$fk_mailbox = $this->getInfo('fk_mailbox');

	// get Mailbox object
	$this->Mailbox = $TSunic->get('$$$Mailbox', $fk_mailbox);

	// return Inbox if Mailbox not valid
	if (!$this->Mailbox or !$this->Mailbox->isValid()) {
	    $this->Mailbox = $TSunic->get('$$$Inbox');
	}

	return $this->Mailbox;
    }

    /** Get Mailaccount object, the serverbox belongs to
     * @param bool $get_id
     *	Get id instead of object
     *
     * @return Mailaccount
     */
    public function getMailaccount ($get_id = false) {
	global $TSunic;

	// is already in obj-vars?
	if (isset($this->Mailaccount) AND !empty($this->Mailaccount))
	    return ($get_id) ? $this->Mailaccount->getInfo('id') : $this->Mailaccount;

	// try to get fk_mailaccount
	$fk_mailaccount = $this->getInfo('fk_mailaccount');
	if (empty($fk_mailaccount)) return false;

	// try to get object
	$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mailaccount);
	if (!$Mailaccount or !$Mailaccount->isValid()) return false;

	// save in obj-var and return
	$this->Mailaccount = $Mailaccount;
	return ($get_id) ? $this->Mailaccount->getInfo('id') : $this->Mailaccount;
    }

    /** Set mailaccount
     * @param Mailaccount $Mailaccount
     *	Mailaccount object
     *
     * @return bool
     */
    public function setMailaccount ($Mailaccount) {
	global $TSunic;

	// is valid mailaccount?
	if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

	// is new mailaccount?
	if ($Mailaccount->getInfo('id') == $this->getInfo('fk_mailaccount'))
	    return true;

	// save in obj-var
	$this->Mailaccount = $Mailaccount;

	// is serverbox-object
	if (!$this->isValid()) {

	    // presets
	    $this->info['fk_mailaccount'] = $Mailaccount->getInfo('id');

	    return true;
	}

	// update database
	$sql = "UPDATE #__$mail$serverboxes
		SET fk_mailaccount = ".$this->Mailaccount->getInfo('id')."
		WHERE id = ".$this->id.";";
	return $TSunic->Db->doUpdate($sql);
    }

    /** Add new serverbox
     * @param int $fk_mailaccount
     *	fk_mailaccount
     * @param string $name
     *	Name of mailbox on server
     * @param int $fk_mailbox
     *	Local mailbox, where new mails are placed in
     * @param bool $deleteOnUpdate
     *	Delete mails on server after saving them locally
     *
     * @return int
     */
    public function create ($fk_mailaccount, $name, $fk_mailbox = false, $deleteOnUpdate = false) {

	// validate input
	if (!$this->isValidFkAccount($fk_mailaccount)
	    OR !$this->isValidName($name)
	    OR !$this->isValidFkmailbox($fk_mailbox)
	) return false;

	// get deleteOnUpdate
	$deleteOnUpdate = ($deleteOnUpdate) ? 1 : 0;

	// update database
	$data = array(
	    "fk_mailaccount" => $fk_mailaccount,
	    "name" => $name,
	    "fk_mailbox" => $fk_mailbox,
	    "deleteOnUpdate" => $deleteOnUpdate
	);
	return $this->_create($data);
    }

    /** Edit serverbox
     * @param string $name
     *	Name of box on server
     * @param int $fk_mailbox
     *	Local mailbox, where new mails are placed in
     * @param bool $deleteOnUpdate
     *	Delete mails on server after saving them locally
     *
     * @return bool
     */
    public function edit ($name, $fk_mailbox, $deleteOnUpdate) {

	// validate input
	if (!$this->isValidName($name)
	    OR !$this->isValidFkmailbox($fk_mailbox)
	) return false;

	// get deleteOnUpdate
	$deleteOnUpdate = ($deleteOnUpdate) ? 1 : 0;

	// update database
	$data = array(
	    "name" => $name,
	    "fk_mailbox" => $fk_mailbox,
	    "deleteOnUpdate" => $deleteOnUpdate
	);
	return $this->_edit($data, true);
    }

    /** Delete serverbox
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /** De-/activate serverbox
     * @param bool $isActive
     *	Activate Serverbox?
     *
     * @return bool
     */
    public function activate ($isActive = true) {
	global $TSunic;
	$isActive = ($isActive) ? 1 : 0;

	// de-/activate serverbox in database
	return $this->_edit(array("isActive" => $isActive));
    }

    /** Check, if name is valid
     * @param string $name
     *	Name of serverbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return $this->_validate($name, 'string');
    }

    /** Check, if fk_mailaccount is valid
     * @param int $fk_mailaccount
     *	fk_mailaccount
     *
     * @return bool
     */
    public function isValidFkAccount ($fk_mailaccount) {
	global $TSunic;

	// try to get Mailaccount object
	$this->Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mailaccount);

	// check, if mailaccount exist
	if ($this->Mailaccount->isValid()) return true;
	return false;
    }

    /** Check, if fk_mailbox is valid
     * @param int $fk_mailbox
     *	fk_mailbox
     *
     * @return bool
     */
    public function isValidFkmailbox ($fk_mailbox) {
	global $TSunic;

	// is active?
	if (!$this->getInfo('isActive')) return true;

	// try to get server-object
	if ($fk_mailbox == 0) {
	    $this->Mailbox = $TSunic->get('$$$Inbox');
	} else {
	    $this->Mailbox = $TSunic->get('$$$Mailbox', $fk_mailbox);
	}

	// check, if mailserver exist
	if ($this->Mailbox->isValid()) return true;
	return false;
    }

    /** Check, if serverbox should be checked for new mails
     *
     * @return bool
     */
    public function isTimeToCheck () {
	return ($this->timeToCheck() <= 0) ? true : false;
    }

    /** Get seconds until checking for new mails
     *
     * @return int
     */
    public function timeToCheck () {

	// get difference to last time
	$last = strtotime($this->getInfo('dateOfCheck'));
	$diff = time() - $last;

	// get seconds until next check
	$next = $this->getInfo('checkAllSeconds') - $diff;
	if ($next < 0) $next = 0;

	return $next;
    }

    /** Check for new emails in this serverbox and store them in db
     * @param bool $force
     *	Force check?
     *
     * @return array
     */
    public function checkMails ($force = false) {
	if (!$this->isValid()) return false;
	global $TSunic;
	$out = array();

	// time to check?
	if (!$force AND !$this->isTimeToCheck()) return true;

	// update dateOfCheck
	$this->setMulti(array('dateOfCheck' => 'NOW()'), true);

	// get remote mails
	$Server = $this->getMailaccount()->getServer();
	if (!$Server) return false;
	$rmails = $Server->getMails($this->getInfo('name'));
	if ($rmails === false) return false;

	// get local mails
	$lmails = $this->getMails();
	if ($lmails === false) return false;

	// delete mail that doesn't not exist anymore
	foreach ($lmails as $index => $Value) {

	    $exists = 0;
	    foreach ($rmails as $in => $val) {

		// skip mails marked for deletion
		if ($val->deleted) continue;

		if ($val->uid == $Value->getInfo('uid')) {
		    $exists = 1;
		    break;
		}
	    }
	    if ($exists) continue;
	    $out[] = $Value->getInfo('uid');

	    // delete mail
	    $Value->delete(false);
	}

	// add new mails
	foreach ($rmails as $index => $values) {

	    // skip mails marked for deletion
	    if ($values->deleted) continue;

	    $exists = 0;
	    foreach ($lmails as $in => $Val) {
		if ($values->uid == $Val->getInfo('uid')) {
		    $exists = 1;
		}
	    }
	    if ($exists) continue;

	    // fetch data of mail
	    $new_mail = $Server->getMail($this->getInfo('name'), $index);

	    // create new Mail
	    $Mail = $TSunic->get('$$$Mail', false, true);
	    if (!$Mail->create()) {
		$TSunic->Log->log(3,
		    "Serverbox: Failed to create new mail!"
		);
		continue;
	    }

	    // get Parser object
	    $Parser = $TSunic->get('$system$Parser');

	    // add bits
	    $Mail->addBit(!$new_mail['seen'], 'MAIL__UNSEEN');
	    $Mail->addBit(
		$Parser->text2int($new_mail['uid']),
		'MAIL__UID'
	    );
	    $Mail->addBit(
		$Parser->text2db($new_mail['sender']),
		'MAIL__SENDER'
	    );
	    $Mail->addBit(
		$Parser->text2db($new_mail['subject']),
		'MAIL__SUBJECT'
	    );
	    $Mail->addBit(
		$Parser->text2db($new_mail['htmlcontent']),
		'MAIL__HTMLCONTENT'
	    );
	    $Mail->addBit(
		$Parser->text2plain2db($new_mail['plaincontent']),
		'MAIL__PLAINCONTENT'
	    );
	    $Mail->addBit($new_mail['charset'], 'MAIL__CHARSET');
	    $Mail->addBit($this->id, 'MAIL__SERVERBOX');
	    $Mail->addBit($this->getInfo('fk_mailbox'), 'MAIL__MAILBOX');
	    $Mail->addBit(strtotime($new_mail['date']), 'MAIL__TIMESTAMP');
	    $Mail->addBit($new_mail['to'], 'MAIL__ADDRESSEE');

	    // add to output
	    $out[] = $new_mail['uid'];

	    // add attachments
	    foreach ($new_mail['attachments'] as $index => $values) {
		$Mail->addAttachment($values['name'], $values['content']);
	    }
	}

	return $out;
    }

    /** Get all mails from this serverbox
     *
     * @return array
     */
    public function getMails () {
	global $TSunic;

	// get all mails from this mailbox
	$Helper = $TSunic->get('$bp$Helper');
	$allmails = $Helper->getObjects('$mail$Mail');

	// filter mails for this serverbox
	$mails = array();
	foreach ($allmails as $index => $Value) {
	    if ($Value->getInfo('serverbox') == $this->id)
		$mails[] = $Value;
	}

	return $mails;
    }
}
?>
