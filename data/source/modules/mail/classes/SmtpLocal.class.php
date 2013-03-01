<!-- | CLASS Local mail sender -->
<?php
class $$$SmtpLocal extends $$$Smtp {

    /* get all data of smtp-server
     * +@param bool/string: name of data (true will return all data)
     * +@param bool: force update of object infos?
     *
     * @return array/false
     */
    public function getInfo ($name = true, $update = true) {
	global $TSunic;

	if (empty($this->info)) {

	    // set data
	    $this->info['emailname'] = $TSunic->Usr->getInfo('name');
	    $this->info['email'] = $TSunic->Config->getConfig('system_email');
	    $this->info['id'] = 0;
	}

	// return requested data
	if ($name === true) return $this->info;
	if (isset($this->info[$name])) return $this->info[$name];
	return false;
    }

    /* get name of this object
     *
     * @return string
     */
    public function getName () {
	$name = $this->getInfo('emailname');
	$name .= " {CLASS__SMTPLOCAL__NAME}";
	return $name;
    }

    /* create new smtp-server
     * @param string: host
     * @param int: port
     * @param string: user
     * @param string: password
     * @param string: email-address
     * @param string: email-name
     *
     * @return bool
     */
    public function create ($email, $password, $description = false, $emailname = false) {
	return false;
    }

    /* edit smtp-server
     * @param string: host
     * @param int: port
     * @param string: user
     * @param string: password
     * @param string: email-address
     * @param string: email-name
     *
     * @return bool
     */
    public function edit ($email, $password, $description = '', $emailname = '') {
	return false;
    }

    /* delete smtp-server
     *
     * @return bool
     */
    public function delete () {
	return false;
    }

    /* check, if smtp-server exists
     *
     * @return bool
     */
    public function isValid () {
	return true;
    }

    /* send mail (either intern or extern)
     * @param object: Mail object to be send
     * @param string: addressee
     *
     * @return bool
     */
    public function send ($Mail, $addressee) {

	// if addressee is valid mail, then send extern, otherwise try
	// intern
	if (!$this->isValidEMail($addressee)) {
	    return $this->sendExtern($Mail, $addressee);
	} else {
	    return $this->sendIntern($Mail, $addressee);
	}
    }

    /* send mail internally to other user
     * @param object: Mail object to be send
     * @param string: addressee
     *
     * @return bool
     */
    public function sendIntern ($Mail, $addressee) {
	if (!$Mail->isValid()) return false;

	// get account id of addressee
	$users = $TSunic->Usr->allUsers();
	$fk_user = 0;
	foreach ($users as $index => $Value) {
	    if ($Value->getInfo('name') == $addressee) {
		$fk_user = $Value->getInfo('id');
		break;
	    }
	}

	// found account?
	if (empty($fk_user)) return false;

	// send mail to this user
	$Mail->push($fk_user, true);

	// save sent mail in sent mailbox

	// TODO
	return false;
    }

    /* send mail via PHP mail function to specified e-mail address
     * @param object: Mail object to be send
     * @param string: addressee
     *
     * @return bool
     */
    public function sendExtern ($Mail, $addressee) {
	if (!$Mail->isValid()) return false;
	global $TSunic;

	// is enabled?
	if (!$TSunic->Config->getConfig('email_enabled')) return false;

	// valid addressee?
	if (!$this->isValidEMail($addressee)) return false;

	// validate sender
	$sender = $this->getInfo('email');
	if (empty($sender)) return false;

	// get header of mail
	$headers = '';
	$headers.= 'From:'.$this->getInfo('emailname').
	    '<'.$this->getInfo('email').'>';

	// send mails
	$this->info['error_msg'] = '';

	$return = mail(
	    $addressee,
	    $Mail->getInfo('subject'),
	    $Mail->getContent(),
	    $headers
	);
	if (!$return) return false;

	return true;
    }
}
?>
