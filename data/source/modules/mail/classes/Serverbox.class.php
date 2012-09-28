<!-- | CLASS Serverbox -->
<?php
include_once '$system$Object.class.php';
class $$$Serverbox extends $system$Object {

    /* tablename in database
     * string
     */
    protected $table = "#__serverboxes";

    /* Mailaccount object
     * object
     */
    protected $Mailaccount;

    /* Mailbox object
     * object
     */
    protected $Mailbox;

    /* temporary cache
     * array
     */
    protected $cache;

    /* get corresponding mailbox object
     *
     * @return OBJECT/bool
     */
    public function getMailbox () {
	if ($this->Mailbox) return $this->Mailbox;

	// get fk_maibox
	$fk_mailbox = $this->getInfo('fk_mailbox');
	if ($fk_mailbox === NULL) return false;

	// get object
	global $TSunic;
	$Mailbox = (is_numeric($fk_mailbox) and !empty($fk_mailbox))
	    ? $TSunic->get('$$$Mailbox', $fk_mailbox) : $TSunic->get('$$$Inbox');
	if (!$Mailbox or !$Mailbox->isValid()) return false;

	// save in obj-var and return
	$this->Mailbox = $Mailbox;
	return $this->Mailbox;
    }

    /* get Mailaccount object, the serverbox belongs to
     * +@param bool: get id instead of object
     *
     * @return OBJECT/bool
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

    /* set mailaccount
     * @param object: mailaccount-object
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
	$sql = "UPDATE #__serverboxes
		SET fk_mailaccount = ".$this->Mailaccount->getInfo('id')."
		WHERE id = ".$this->id.";";
	return $TSunic->Db->doUpdate($sql);
    }

    /* add new serverbox
     * @param int: fk_mailaccount
     * @param string: name of mailbox on server
     * +@param int: local mailbox, where new mails are placed in
     * +@param bool: delete mails on server after saving them locally
     *
     * @return bool
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

    /* edit serverbox
     * @param string: name of box on server
     * @param int: local mailbox, where new mails are placed in
     * @param bool: delete mails on server after saving them locally
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
	return $this->_edit($data);
    }

    /* delete serverbox
     *
     * @return bool
     */
    public function delete () {
	return $this->_delete();
    }

    /* de-/activate serverbox
     * @param bool: activate Serverbox?
     *
     * @return bool
     */
    public function activate ($isActive = true) {
	global $TSunic;
	$isActive = ($isActive) ? 1 : 0;

	// de-/activate serverbox in database
	return $this->_edit(array("isActive" => $isActive));
    }

    /* check, if name is valid
     * @param string: name of serverbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return $this->_validate($name, 'string');
    }

    /* check, if fk_mailaccount is valid
     * @param int: fk_mailaccount
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

    /* check, if fk_mailbox is valid
     * @param int: fk_mailbox
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

    /* check, if serverbox should be checked for new mails
     *
     * @return bool
     */
    public function isTimeToCheck () {
	return ($this->timeToCheck() <= 0) ? true : false;
    }

    /* get seconds until checking for new mails
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

    /* check for new emails in this serverbox and store them in db
     * +@param bool: force check?
     *
     * @return array with ids of new mails
     */
    public function checkMails ($force = false) {
	global $TSunic;
	$out = array();

	// check, if serverbox exist
	if (!$this->isValid()) return false;

	// time to check?
	if (!$force AND !$this->isTimeToCheck()) return true;

	// update dateOfCheck
	$sql = "UPDATE #__serverboxes
		SET dateOfCheck = NOW()
		WHERE id = '".$this->id."'";
	$result = $TSunic->Db->doUpdate($sql);

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
	    $Mail = $TSunic->get('$$$Mail');
	    $Mail->createFromImap(
		$this->id,
		$this->getInfo('fk_mailbox'),
		$new_mail['sender'],
		$new_mail['to'],
		$new_mail['date'],
		$new_mail['subject'],
		$new_mail['plaincontent'],
		$new_mail['htmlcontent'],
		$new_mail['uid'],
		!$new_mail['seen'],
		$new_mail['charset']
	    );
	    $out[] = $new_mail['uid'];

	    // add attachments
	    foreach ($new_mail['attachments'] as $index => $value) {
		$Attachment = $TSunic->get('$usersystem$');
		$Attachment->create(0, $index, $value);
		$Mail->addAttachment($Attachment);
	    }
	}

	return $out;
    }

    /* get all mails from this serverbox
     *
     * @return array
     */
    public function getMails () {
	global $TSunic;

	// get all mails from this mailbox
	$sql = "SELECT id
	    FROM #__mails
	    WHERE fk_serverbox = '".$this->id."';";
	$ids = $TSunic->Db->doSelect($sql);
	if (!$ids) return $ids;

	// get objects
	$mails = array();
	foreach ($ids as $index => $values) {
	    $mails[] = $TSunic->get('$$$Mail', $values['id']);
	}

	return $mails;
    }
}
?>
