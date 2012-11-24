<!-- | CLASS ImapServer -->
<?php
class $$$ImapServer {

    /* connection details
     * array
     */
    protected $conn;

    /* streams to mailboxes
     * array
     */
    protected $streams;

    /* timeout
     * int
     */
    protected $timeout;

    /* cache
     * array
     */
    protected $cache;

    /* cached mails in mailbox
     * array
     */
    protected $mails;

    /* constructor
     * @param string: host
     * @param int: port
     * @param string: user
     * @param string: password
     * @param int: protocol
     * @param int: auth
     * @param int: connsecurity
     */
    public function __construct ($host, $port, $user, $password, $protocol, $auth, $connsecurity) {

	// save connection details
	$this->conn = array(
	    "host" => $host,
	    "port" => $port,
	    "user" => $user,
	    "password" => $password,
	    "protocol" => $protocol,
	    "auth" => $auth,
	    "connsecurity" => $connsecurity
	);

	// set timeout for opening and reading a connection
	imap_timeout(IMAP_OPENTIMEOUT, $this->timeout);
	imap_timeout(IMAP_READTIMEOUT, $this->timeout);
    }

    /* get mboxstr
     * +@param string: name of mailbox
     *
     * @return string
     */
    protected function getMboxstr ($mailbox = '') {

	// get connection details
	$host = $this->conn{'host'};
	$port = $this->conn{'port'};
	$user = $this->conn{'user'};
	$password = $this->conn{'password'};
	$protocol = $this->conn{'protocol'};
	$auth = $this->conn{'auth'};
	$connsecurity = $this->conn{'connsecurity'};

	// convert
	if (!empty($protocol)) $protocol = "/".$protocol;
	if (!empty($auth)) $auth = "/".$auth;
	if (!empty($connsecurity)) $connsecurity= "/".$connsecurity;

	// validate
	if (empty($host) or empty($port) or !is_numeric($port)
	    or empty($user)
	) {
	    return NULL;
	}

	// get string to open stream
	$mboxstr= '{'.$host.':'.$port.$auth.$connsecurity.'}'.$mailbox;

	return $mboxstr;
    }

    /* connect to server
     * +@param string: name of mailbox
     * +@param bool: log errors?
     *
     * @return stream-object
     */
    protected function connect ($mailbox = '', $error = true) {
	if (isset($this->streams[$mailbox])) return $this->streams[$mailbox];
	global $TSunic;

	// check, if imap-functions exist
	if (!function_exists('imap_timeout')) {
	    die('IMAP functions are not supported by this server!');
	    return false;
	}

	// get string to open stream
	$mboxstr= $this->getMboxstr($mailbox);
	if (!$mboxstr) return NULL;

	// open stream
	$TSunic->Log->log(8, "Mailaccount->getStream: imap_open to $mboxstr with ".$this->conn{'user'}." and ".$this->conn{'password'});
	$stream = imap_open($mboxstr, $this->conn{'user'}, $this->conn{'password'});

	// success?
	if ($stream) {
	    $this->streams[$mailbox] = $stream;
	    return $stream;
	}

	// error
	$imap_errors = imap_errors();
	if ($error and $imap_errors) {
	    $TSunic->Log->log(
		8, "Mailaccount->getStream: ".implode(",", $imap_errors)
	    );
	}

	// check, if imap-stream exist
	if ($error) {
	    $error = '{CLASS__MAILACCOUNT__NOCONNECTION}'.
		' (server: '.$this->conn{'host'}.', user: '.$this->conn{'user'}.
		', mailbox: '.$mailbox.
		')';

	    // add error
	    $TSunic->Log->alert('error', $error);
	    $TSunic->Log->log(3, $error);
	}

	return NULL;
    }

    /* disconnect all streams
     */
    public function disconnect () {
	foreach ($this->streams as $index => $value) {
	    @imap_close($value);
	}
    }

    /* get all mailboxes on server
     *
     * @return bool/array
     */
    public function getServerboxes () {

	// connect
	$stream = $this->connect();
	if (!$stream) return false;

	// get mboxstr
	$mboxstr = $this->getMboxstr();
	if (!$mboxstr) return false;

	// get list of all mailboxes
	$mailboxes_raw = imap_getmailboxes($stream, $mboxstr, '*');

	// get output array
	$mailboxes = array();
	foreach ($mailboxes_raw as $index => $Value) {
	    $name = utf8_encode(imap_utf7_decode($Value->name));
	    $name = preg_replace('!(\{(.*)\})!Usi', '', $name);
	    $mailboxes[] = $name;
	}

	return $mailboxes;
    }

    /* get all mails in mailbox on server
     * @param string: mailbox
     *
     * @return array/bool
     */
    public function getMails ($mailbox) {
	if ($this->mails[$mailbox]) return $this->mails[$mailbox];

	// connect
	$stream = $this->connect($mailbox);
	if (!$stream) return false;

	// get list of all mails
	$list = @imap_check($stream);
	$number_of_mails = $list->Nmsgs;
	if ($number_of_mails < 1) return array();

	// get overview
	$this->mails[$mailbox] = imap_fetch_overview($stream, "1:$number_of_mails", 0);

	return $this->mails[$mailbox];
    }

    /* delete mail on server
     * @param string: mailbox
     * @param int: uid of mail
     * +@param bool: expunge?
     *
     * @return bool
     */
    public function deleteMail ($mailbox, $uid, $cleanup = true) {

	// get msg_num to uid
	$mails = $this->getMails($mailbox);
	$msg_num = false;
	foreach ($mails as $index => $values) {

	    if ($values->uid == $uid) {
		$msg_num = $index;
		break;
	    }
	}
	if ($msg_num === false) return false;

	// delete mail
	$stream = $this->connect($mailbox);
	if ($stream and imap_delete($stream, $msg_num)) {
	    // delete mails marked for deletion.
	    // ATTENTION: This will change msg_nums of all other mails!
	    if (!$cleanup or imap_expunge($stream)) return true;
	}

	return false;
    }

    /* load all data of mail
     * @param string: mailbox
     * @param int: number of mail
     *
     * @return array
     */
    public function getMail ($mailbox, $msg_num) {

	// connect
	$stream = $this->connect($mailbox);
	if (!$stream) return false;

	// get mail object
	$all_mails = $this->getMails($mailbox);
	if (!isset($all_mails[$msg_num])) return NULL;
	$Mail = $all_mails[$msg_num];
	$msg_num++;

	// init
	$out = array();

	// get details
	$out['subject'] = $this->decodeValue($Mail->subject);
	$out['sender'] = $this->decodeValue($Mail->from);
	$out['to'] = $this->decodeValue($Mail->to);
	$out['date'] = date('Y-m-d H:i:s', strtotime($Mail->date));
	$out['uid'] = $Mail->uid;
	$out['seen'] = $Mail->seen;

	// init bodyparts
	$this->cache = array(
	    'plain' => '',
	    'html' => '',
	    'attachments' => array(),
	    'charset' => ''
	);

	// get body-parts of mail
	$structure = imap_fetchstructure($stream, $msg_num);

	if (!isset($structure->parts))  {
	    // no multipart
	    $this->getpart($stream, $msg_num, $structure, 0);
	} else {
	    // multipart: iterate through each part
	    foreach ($structure->parts as $partnumber => $part) {
		// get part
		$this->getpart($stream, $msg_num, $part, ($partnumber+1));
	    }
	}

	// save bodyparts
	$out['plaincontent'] = $this->cache['plain'];
	$out['htmlcontent'] = $this->cache['html'];
	$out['charset'] = $this->cache['charset'];
	$out['attachments'] = $this->cache['attachments'];

	// clear cache
	$this->cache = array();

	return $out;
    }

    /* check, if connection can be established
     *
     * @return bool
     */
    public function isValid () {
	return ($this->connect()) ? true : false;
    }

    /* get parts of mail (plainbody, htmlbody, attatchments etc)
     * @param stream: stream to fetch mails from
     * @param int: mail-id
     * @param object: part of mail
     * @param int: part-number
     *
     * @return bool
     */
    protected function getpart ($stream, $mail_id, $part, $partnumber) {

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
	    $this->cache['attachments'][] = array(
		'name' => $this->decodeValue($filename),
		'content' => $bodydata
	    );
	}

	// get message
	elseif ($part->type == 0 AND isset($bodydata)) {

	    // add message
	    if (strtolower($part->subtype) == 'plain') {
		// plaintext
		$this->cache['plain'].= trim($bodydata)."\n\n";
	    } else {
		// html-text
		$this->cache['html'].= trim($bodydata)."<br /><br />";
	    }

	    // add charset
	    if (isset($params['charset']))
		$this->cache['charset'] = $params['charset'];
	}

	// EMBEDDED MESSAGE
	// Many bounce notifications embed the original message as type 2,
	// but AOL uses type 1 (multipart), which is not handled here.
	// There are no PHP functions to parse embedded messages,
	// so this just appends the raw source to the main message.
	elseif ($part->type==2 AND isset($bodydata)) {
	    $this->cache['plain'].= trim($bodydata) ."\n\n";
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
			$this->cache[$bodytype].= $val;
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
