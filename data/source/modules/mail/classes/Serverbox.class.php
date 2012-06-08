<!-- | Serverbox class -->
<?php
include_once '$system$Object.class.php';
class $$$Serverbox extends $system$Object {

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

    /* load infos from database
     *
     * @return sql query
     */
    protected function loadInfoSql () {
	return "SELECT _name_ as name,
		    fk_mailaccount as fk_mailaccount,
		    fk_mailbox as fk_mailbox,
		    deleteOnUpdate as deleteOnUpdate,
		    dateOfCreation as dateOfCreation,
		    dateOfUpdate as dateOfUpdate,
		    dateOfCheck as dateOfCheck,
		    checkAllSeconds as checkAllSeconds,
		    isActive as isActive
		FROM #__serverboxes
		WHERE id = '".$this->id."';";
    }

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

	// add new serverbox in database
	$sql = "INSERT INTO #__serverboxes
		SET fk_mailaccount = '".$fk_mailaccount."',
		    _name_ = '".$name."',
		    fk_mailbox = '".$fk_mailbox."',
		    deleteOnUpdate = '".$deleteOnUpdate."'
	;";
	return $this->_create($sql);
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

	// add new serverbox in database
	$sql = "UPDATE #__serverboxes
		SET _name_ = '".$name."',
		    fk_mailbox = '".$fk_mailbox."',
		    deleteOnUpdate = '".$deleteOnUpdate."'
		WHERE id = '".$this->id."'
	;";
	return $this->_edit($sql);
    }

    /* delete serverbox
     *
     * @return bool
     */
    public function delete () {
	$sql = "DELETE FROM #__serverboxes
		WHERE id = '".$this->id."';";
	return $this->_delete($sql);
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
	$sql = "UPDATE #__serverboxes
		SET isActive = '$isActive'
		WHERE id = '".$this->id."'
	;";
	return $TSunic->Db->doUpdate($sql);
    }

    /* check, if name is valid
     * @param string: name of serverbox
     *
     * @return bool
     */
    public function isValidName ($name) {
	return ($this->_validate($name, 'string')) ? true : false;
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

	// check, if serverbox exist
	if (!$this->isValid()) return false;

	// time to check?
	if (!$force AND !$this->isTimeToCheck()) return true;

	// update dateOfCheck
	$sql = "UPDATE #__serverboxes
		SET dateOfCheck = NOW()
		WHERE id = '".$this->id."'";
	$result = $TSunic->Db->doUpdate($sql);

	// get connection to serverbox on server
	$stream = $this->getMailaccount()->getStream($this->getInfo('name'));
	if (!$stream) return false;

	// get number and headers of all mails
	$headers = @imap_check($stream);
	$number_of_mails = $headers->Nmsgs;
	if ($number_of_mails < 1) return array();

	// get overview
	$overview = imap_fetch_overview($stream, "1:$number_of_mails", 0);

	// get msg-numbers of all mails already stored locally
	$sql = "SELECT uid as uid
		FROM #__mails
		WHERE fk_serverbox = '".$this->id."';";
	$return = $TSunic->Db->doSelect($sql);
	if ($return === false) return false;

	// get uids
	$storedUids = array();
	foreach ($return as $index => $value) {
	    $storedUids[] = $value['uid'];
	}

	// read all messages on the server and update local database
	$new_mails = array();
	for ($i = 0; $i < $number_of_mails; $i++) {
	    $mail = $overview[$i];

	    // get uid and message_number
	    $uid = $mail->uid;
	    $msg_number = $i + 1;

	    // skip, if already downloaded
	    if (in_array($uid, $storedUids)) continue;

	    // get header-infos
	    $subject = $this->decodeValue($mail->subject);
	    $from = $this->decodeValue($mail->from);
	    $to = $this->decodeValue($mail->to);
	    $date = date('Y-m-d H:i:s', strtotime($mail->date));

	    // init bodyparts
	    $this->cache['bodyparts'] = array(
		'plain' => '',
		'html' => '',
		'attachments' => array(),
		'charset' => ''
	    );

	    // get body-parts of mail
	    $structure = imap_fetchstructure($stream, $msg_number);

	    if (!isset($structure->parts))  {
		// no multipart
		$this->getpart($stream, $msg_number, $structure, 0);
	    } else {
		// multipart: iterate through each part
		foreach ($structure->parts as $partnumber => $part) {
		    // get part
		    $this->getpart($stream, $msg_number, $part, ($partnumber+1));
		}
	    }

	    // create new Mail
	    $Mail = $TSunic->get('$$$Mail');
	    if (!$Mail->createFromImap(
		$this->id,
		$this->getInfo('fk_mailbox'),
		$from,
		$to,
		$subject,
		$this->cache['bodyparts']['plain'],
		$this->cache['bodyparts']['html'],
		$uid,
		1,
		$this->cache['bodyparts']['charset']
	    )) {
		continue;
	    }

	    // save attachments
	    foreach ($this->cache['bodyparts']['attachments'] as $index => $values) {

		// create new FsFile
		$FsFile = $TSunic->get('$usersystem$FsFile');
		if (!$FsFile->create(0, $values['name'], $values['content'])) {
		    $TSunic->Log->alert('error', '{CLASS__SERVERBOX__ADDATTACHMENTERROR}');
		}

		// link as attachment
		$Mail->addAttachment($FsFile->getInfo('id'));
	    }

	    // clear data
	    $this->cache['bodyparts'] = array();

	    // get new inserted id
	    $new_mails[] = $Mail->getInfo('id');
	}

	return $new_mails;
    }

    /* get parts of mail (plainbody, htmlbody, attatchments etc)
     * @param stream: stream to fetch mails from
     * @param int: mail-id
     * @param object: part of mail
     * @param int: part-number
     *
     * @return bool
     */
    function getpart ($stream, $mail_id, $part, $partnumber) {

	// get body
	if ($partnumber == 0) {
	    // no multipart
	    $bodydata = imap_body($stream, $mail_id);
	} else {
	    // multipart
	    $bodydata = imap_fetchbody($stream, $mail_id, $partnumber);
	}

	// decode data (if neccesary)
	if ($part->encoding == 4) {
	    // decode
	    $bodydata = quoted_printable_decode($bodydata);
	} elseif ($part->encoding == 3) {
	    // decode
	    $bodydata = base64_decode($bodydata);
	}

	// get parameters
	$params = array();
	if (isset($part->parameters)) {
	    foreach ($part->parameters as $x) {
		$params[strtolower($x->attribute)] = $x->value;
	    }
	}
	if (isset($part->dparameters)) {
	    foreach ($part->dparameters as $x) {
		$params[strtolower($x->attribute)] = $x->value;
	    }
	}

	// get attachments
	if (isset($params['filename']) OR isset($params['name'])) {
	    // attachment exists

	    // get name of attachment
	    $filename = (isset($params['filename'])) ? $params['filename'] : $params['name'];

	    // add attachment
	    $this->cache['bodyparts']['attachments'][] = array(
		'name' => $this->decodeValue($filename),
		'content' => $bodydata
	    );
	}

	// get message
	elseif ($part->type == 0 AND isset($bodydata)) {

	    // add message
	    if (strtolower($part->subtype) == 'plain') {
		// plaintext
		$this->cache['bodyparts']['plain'].= trim($bodydata)."\n\n";
	    } else {
		// html-text
		$this->cache['bodyparts']['html'].= trim($bodydata)."<br /><br />";
	    }

	    // add charset
	    if (isset($params['charset']))
		$this->cache['bodyparts']['charset'] = $params['charset'];
	}

	// EMBEDDED MESSAGE
	// Many bounce notifications embed the original message as type 2,
	// but AOL uses type 1 (multipart), which is not handled here.
	// There are no PHP functions to parse embedded messages,
	// so this just appends the raw source to the main message.
	elseif ($part->type==2 AND isset($bodydata)) {
	    $this->cache['bodyparts']['plain'].= trim($bodydata) ."\n\n";
	}

	// try to get aol-multipart messages
	elseif ($part->type == 1 AND isset($bodydata)) {

	    // split to lines
	    $lines = explode(chr(10), $bodydata);
	    $cutter = trim($lines[1]);

	    // split in parts
	    $myparts = explode($cutter, $bodydata);
	    foreach ($myparts as $index => $value) {
		if (empty($value)) continue;

		// split in lines
		$lines = explode(chr(10), $value);

		$is_message = NULL;
		$bodytype = 'html';
		foreach ($lines as $in => $val) {

		    if (isset($is_message) AND $is_message) {
			$this->cache['bodyparts'][$bodytype].= $val;
		    } else {
			$val_trimmed = trim($val);
			if (empty($val_trimmed)) {
			    if (!isset($is_message)) continue;
			    $is_message = true;
			    continue;
			}
			$is_message = false;

			// get bodytype
			if (strstr($val, 'plain')) $bodytype = 'plain';

			// get encoding
			// TODO
		    }
		}
	    }
	}

	// add subparts
	if (isset($parts->parts)) {
	    foreach ($part->parts as $partno0 => $p2)
		$this->getpart($stream, $mail_id, $p2, $partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
	}

	return true;
    }

    /* decode value
     * @param string: subject to decode
     *
     * @return string
     */
    protected function decodeValue ($value){
	return $this->decodeMimeString($value);
    }

    /* return supported encodings in lowercase
     * @source: http://php.net/imap_mime_header_decode (comments)
     *
     * @return array
     */
    protected function mb_list_lowerencodings () {
	$r=mb_list_encodings();
	for ($n=sizeOf($r); $n--; ) {
	    $r[$n]=strtolower($r[$n]);
	}

	return $r;
    }

    /* decode a mail-header string to a specified charset
     * @source: http://php.net/imap_mime_header_decode (comments)
     * @param string: mime-string
     * +@param string: input-charset
     * +@param string: target-charset
     *
     * @return string
     */
    protected function decodeMimeString ($mimeStr, $inputCharset='utf-8', $targetCharset='utf-8', $fallbackCharset='iso-8859-1') {

	// get charsets
	$encodings = $this->mb_list_lowerencodings();
	$inputCharset = strtolower($inputCharset);
	$targetCharset = strtolower($targetCharset);
	$fallbackCharset = strtolower($fallbackCharset);

	// decode
	$decodedStr = '';
	$mimeStrs = imap_mime_header_decode($mimeStr);
	for ($n = count($mimeStrs), $i=0; $i<$n; $i++) {
	    $mimeStr = $mimeStrs[$i];
	    $mimeStr->charset=strtolower($mimeStr->charset);
	    if (($mimeStr == 'default' && $inputCharset == $targetCharset)
		    OR $mimeStr->charset == $targetCharset
	    ) {
		$decodedStr.=$mimeStr->text;
	    } else {
		$decodedStr.= mb_convert_encoding(
		    $mimeStr->text,
		    $targetCharset,
		    (in_array($mimeStr->charset, $encodings) ? $mimeStr->charset : $fallbackCharset)
		);
	    }
	}

	return $decodedStr;
    }
}
?>
