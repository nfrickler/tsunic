<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			classes/Serverbox.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$Serverbox {

	/* name of mailserver
	 * string
	 */
	private $id_mail__serverbox;

	/* information about serverbox
	 * array
	 */
	private $info;

	/* mail-account-object
	 * object
	 */
	private $Mailaccount;

	/* temporary cache
	 * array
	 */
	private $cache;

	/* constructor
	 * +@params int $id_mail_serverbox: id_mail__serverbox
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_mail__serverbox = 0, $Mailaccount = false) {

		// save input
		$this->id_mail__serverbox = $id_mail__serverbox;
		if (!empty($Mailaccount)) $this->Mailaccount = $Mailaccount;

		return;
	}

	/* get all data of mailserverbox
	 * +@param bool/string $name: name of data (true will return all data)
	 *
	 * @return array
	 * 		   (OR @return bool: false - error)
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		// check, if info already in cache
		if (!empty($this->id_mail__serverbox) AND empty($this->info)) {

			// get data from database
			$sql_0 = "SELECT _name_ as name,
							 fk_mail__account as fk_mail__account,
							 fk_mail__box as fk_mail__box,
							 deleteOnUpdate as deleteOnUpdate,
							 dateOfCreation as dateOfCreation,
							 dateOfUpdate as dateOfUpdate,
							 dateOfCheck as dateOfCheck,
							 checkAllSeconds as checkAllSeconds,
							 isActive as isActive
					  FROM #__serverboxes
					  WHERE id_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."';";
			$result_0 = $TSunic->Db->doSelect($sql_0);

			// return, if no server matched
			if (empty($result_0)) return false;

			// store data
			$this->info = $result_0[0];
			$this->info['id_mail__serverbox'] = $this->id_mail__serverbox;

			// add mailbox-object
			if ($this->info['fk_mail__box'] == 0) {
				$this->info['Mailbox'] = $TSunic->get('$$$Inbox');
			} else {
				$this->info['Mailbox'] = $TSunic->get('$$$Box', $this->info['fk_mail__box']);
			}

			// get and save Mailaccount-object
			if (empty($this->Mailaccount))
				$this->Mailaccount = $TSunic->get('$$$Account', $this->info['fk_mail__account']);
			$this->info['Mailaccount'] = $this->Mailaccount;
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* get mailaccount-object, the serverbox belongs to
	 * +@param bool $get_id: get id_mail__account instead of object
	 *
	 * @return OBJECT/bool
 	 */
	public function getMailaccount ($get_id = false) {
		global $TSunic;

		// is already in obj-vars?
		if (isset($this->Mailaccount) AND !empty($this->Mailaccount))
			return ($get_id) ? $this->Mailaccount->getInfo('id_mail__account') : $this->Mailaccount;

		// try to get fk_mail__account
		$fk_mail__account = $this->getInfo('fk_mail__account');
		if (empty($fk_mail__account)) return false;

		// try to get object
		$Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);
		if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

		// save in obj-var and return
		$this->Mailaccount = $Mailaccount;
		return ($get_id) ? $this->Mailaccount->getInfo('id_mail__account') : $this->Mailaccount;
	}

	/* set mailaccount
	 * @param object $Mailaccount: mailaccount-object
	 *
	 * @return bool
 	 */
	public function setMailaccount ($Mailaccount) {
		global $TSunic;

		// is valid account?
		if (!$Mailaccount OR !$Mailaccount->isValid()) return false;

		// is new mailaccount?
		if ($Mailaccount->getInfo('id_mail__account') == $this->getInfo('fk_mail__account'))
			return true;

		// save in obj-var
		$this->Mailaccount = $Mailaccount;

		// is serverbox-object
		if (!$this->isValid()) {

			// presets
			$this->info['fk_mail__account'] = $Mailaccount->getInfo('id_mail__account');

			return true;
		}

		// update database
		$sql_0 = "UPDATE #__serverboxes
					SET fk_mail__account = ".$this->Mailaccount->getInfo('id_mail__account')."
					WHERE id_mail__serverbox = ".$this->id_mail__serverbox.";";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		return true;
	}

	/* update info-data
	 *
	 * @return true
 	 */
	protected function updateInfo () {

		// reset info
		$this->info = array();

		return true;
	}

	/* add new serverbox
	 * @param int $fk_mail__account: fk_mail__account
	 * @param string $name: name of box on server
	 * +@param int $fk_mail__box: local mailbox, where new mails are placed in
	 * +@param bool $deleteOnUpdate: delete mails on server after saving them locally	 	 	 	 	 	 	 
	 *
	 * @return bool
 	 */
	public function createServerbox ($fk_mail__account, $name, $fk_mail__box = false, $deleteOnUpdate = false) {
		global $TSunic;

		// validate input
		$fk_mail__box = (int) $fk_mail__box;
		if (!$this->isValidFkAccount($fk_mail__account)
				OR !$this->isValidName($name)
				OR !$this->isValidFkmailbox($fk_mail__box)
		) {
			// invalid input
			return false;		
		}

		// get deleteOnUpdate
		$deleteOnUpdate = ($deleteOnUpdate) ? 1 : 0;

		// add new serverbox in database
		$sql_0 = "INSERT INTO #__serverboxes
				  SET fk_mail__account = '".mysql_real_escape_string($fk_mail__account)."',
				  	  _name_ = '".mysql_real_escape_string($name)."',
				  	  fk_mail__box = '".mysql_real_escape_string($fk_mail__box)."',
				  	  deleteOnUpdate = '".mysql_real_escape_string($deleteOnUpdate)."'
				  ;";
		$result_0 = $TSunic->Db->doInsert($sql_0);

		// update $this->info
		$this->id_mail__serverbox = mysql_insert_id();
		$this->updateInfo();

		// return
		if ($result_0) return true;
		return false;
	}

	/* edit serverbox
	 * @param string $name: name of box on server
	 * @param int $fk_mail__box: local mailbox, where new mails are placed in
	 * @param bool $deleteOnUpdate: delete mails on server after saving them locally	 	 	 	 	 	 	 
	 *
	 * @return bool
 	 */
	public function editServerbox ($name, $fk_mail__box, $deleteOnUpdate) {
		global $TSunic;

		// validate input
		$fk_mail__box = (int) $fk_mail__box;
		if (!$this->isValidName($name)
				OR !$this->isValidFkmailbox($fk_mail__box)
		) {
			// invalid input
			return false;	
		}

		// get deleteOnUpdate
		$deleteOnUpdate = ($deleteOnUpdate) ? 1 : 0;

		// add new serverbox in database
		$sql_0 = "UPDATE #__serverboxes
				  SET _name_ = '".mysql_real_escape_string($name)."',
				  	  fk_mail__box = '".mysql_real_escape_string($fk_mail__box)."',
				  	  deleteOnUpdate = '".mysql_real_escape_string($deleteOnUpdate)."'
				  WHERE id_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."'
				  ;";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// update $this->info
		$this->updateInfo();

		// return
		if ($result_0) return true;
		return false;
	}

	/* de-/activate serverbox
	 * @param bool $isActive: true - activate; false - deactivate	 	 	 	 	 	 	 
	 *
	 * @return bool
 	 */
	public function activate ($isActive = true) {
		global $TSunic;

		// get sql-isActive
		$isActive = ($isActive) ? 1 : 0;

		// de-/activate serverbox in database
		$sql_0 = "UPDATE #__serverboxes
				  SET isActive = '".$isActive."',
				  	  dateOfUpdate = NOW()
				  WHERE id_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."'
				  ;";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

		// return
		if ($result_0) return true;
		return false;
	}

	/* delete serverbox
	 *
	 * @return bool
 	 */
	public function deleteServerbox () {
		global $TSunic;

		// delete mailserverbox in database
		$sql_0 = "DELETE FROM #__serverboxes
				  WHERE id_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."';";
		$result_0 = $TSunic->Db->doDelete($sql_0);

		if (!$result_0) return false;
		return true;
	}

	/* check, if name is valid
	 * @param string $name: name of serverbox
	 *
	 * @return bool
 	 */
	public function isValidName ($name) {

		// check, if string is empty
		if (empty($name)) return false;

		return true;
	}

	/* check, if fk_mail__account is valid
	 * @param int $fk_mail__account: fk_mail__account
	 *
	 * @return bool
 	 */
	public function isValidFkAccount ($fk_mail__account) {
		global $TSunic;

		// try to get imap-object
		$this->Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);

		// check, if mailaccount exist
		if ($this->Mailaccount->isValid()) return true;
		return false;
	}

	/* check, if fk_mail__box is valid
	 * @param int $fk_mail__box: fk_mail__box
	 *
	 * @return bool
 	 */
	public function isValidFkmailbox ($fk_mail__box) {
		global $TSunic;

		// is active?
		if (!$this->getInfo('isActive')) return true;

		// try to get server-object
		if ($fk_mail__box == 0) {
			$this->Mailbox = $TSunic->get('$$$Inbox');
		} else {
			$this->Mailbox = $TSunic->get('$$$Box', $fk_mail__box);
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
	 * +@param bool $force: force check?
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
		$sql_0 = "UPDATE #__serverboxes
					SET dateOfCheck = NOW()
					WHERE id_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."'
					  ";
		$result_0 = $TSunic->Db->doUpdate($sql_0);

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
		$sql_0 = "SELECT uid as uid
				  FROM #__mails
				  WHERE fk_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."';";
		$return_0 = $TSunic->Db->doSelect($sql_0);
		if ($return_0 === false) return false;

		// get uids
		$storedUids = array();
		foreach ($return_0 as $index => $value) {
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
			$this->cache['bodyparts'] = array('plain' => '',
											  'html' => '',
											  'attachments' => array(),
											  'charset' => '');

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

			// validate plaincontent
			$this->cache['bodyparts']['plain'] = str_replace('<', '&lt;', $this->cache['bodyparts']['plain']);
			$this->cache['bodyparts']['plain'] = str_replace('>', '&gt;', $this->cache['bodyparts']['plain']);
			$this->cache['bodyparts']['plain'] = str_replace("'", '"', $this->cache['bodyparts']['plain']);
			$this->cache['bodyparts']['html'] = str_replace("'", '"', $this->cache['bodyparts']['html']);
			$subject = str_replace("'", '"', $subject);

			// render sender and addressee
			$from = str_replace('<', '&lt;', $from);
			$from = str_replace('>', '&gt;', $from);
			$to = str_replace('<', '&lt;', $to);
			$to = str_replace('>', '&gt;', $to);

			// save locally
			$sql_1 = "INSERT INTO #__mails
					  SET fk_mail__serverbox = '".mysql_real_escape_string($this->id_mail__serverbox)."',
					  	  fk_mail__box = '".mysql_real_escape_string($this->getInfo('fk_mail__box'))."',
					  	  _subject_ = '".mysql_real_escape_string($subject)."',
					  	  _plaincontent_ = '".$TSunic->Parser->toSave($this->cache['bodyparts']['plain'])."',
					  	  _htmlcontent_ = '".$TSunic->Parser->toSave($this->cache['bodyparts']['html'])."',
					  	  charset = '".mysql_real_escape_string($this->cache['bodyparts']['charset'])."',
					  	  _sender_ = '".mysql_real_escape_string($from)."',
					  	  _addressee_ = '".mysql_real_escape_string($to)."',
					  	  dateOfMail = '".mysql_real_escape_string($date)."',
					  	  status = '1',
					  	  uid = '".mysql_real_escape_string($uid)."'
					  ";
			$result_1 = $TSunic->Db->doInsert($sql_1);
			$id_mail__mail = mysql_insert_id();

			// save attachments
			foreach ($this->cache['bodyparts']['attachments'] as $index => $values) {

				// create new attachment
				$Attachment = $TSunic->get('$$$Attachment', array(), true);

				// create new
				if (!$Attachment->createAttachment($id_mail__mail, $values['name'], $values['content'])) {
					// an error occurred!
					$TSunic->Log->add('error', '{CLASS__SERVERBOX__ADDATTACHMENTERROR}');
				}
			}

			// clear data
			$this->cache['bodyparts'] = array();

			// get new inserted id
			$new_mails[] = $id_mail__mail;
		}

		return $new_mails;
	}

	/* get parts of mail (plainbody, htmlbody, attatchments etc)
	 * @param stream $stream: stream to fetch mails from
	 * @param int $mail_id: mail-id
	 * @param object $part: part of mail
	 * @param int $partnumber: part-number	 	 	 
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
			$this->cache['bodyparts']['attachments'][] = array('name' => $this->decodeValue($filename),
															   'content' => $bodydata);
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

	/* check, if serverbox exists
	 *
	 * @return bool
 	 */
	public function isValid () {

		// check, if id exists
		if (!isset($this->id_mail__serverbox) OR empty($this->id_mail__serverbox))
			return false;

		// check, if serverbox in database
		$dateOfCreation = $this->getInfo('dateOfCreation');
		if (empty($dateOfCreation)) return false;

		return true;
	}

	/* decode value
	 * @param string $subject: subject to decode
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
	 * @param string $mimeStr: mime-string
	 * +@param string $inputCharset: input-charset
	 * +@param string $targetCharset: target-charset	 
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
				$decodedStr.= mb_convert_encoding($mimeStr->text,
												  $targetCharset,
												  (in_array($mimeStr->charset, $encodings) ? $mimeStr->charset : $fallbackCharset)
												 );
			}
		}

		return $decodedStr;
	}
}
?>