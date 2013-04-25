<!-- | CLASS Local mail sender -->
<?php
class $$$SmtpLocal extends $$$Smtp {

    /* get default value for specific field
     * @param string: name of field
     *
     * @return mix
     */
    public function getDefault ($name) {
	global $TSunic;
	switch ($name) {
	    case 'emailname':
		return $TSunic->Usr->getInfo('name');
	    case 'email':
		return $TSunic->Config->get('system_email');
	    default:
	}
	return NULL;
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
	if ($this->isValidEMail($addressee)) {
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
	global $TSunic;

	// get account id of addressee
	$users = $TSunic->Usr->allUsers();
	$fk_user = 0;
	foreach ($users as $index => $value) {
	    if ($value == $addressee) {
		$fk_user = $index;
		break;
	    }
	}

	// found account?
	if (empty($fk_user)) return false;

	// do not send to guest!
	if ($fk_user == $TSunic->Usr->getIdGuest()) return false;

	// send mail to this user
	if (!$Mail->pushTo($fk_user)) return false;

	// save sent mail in sent mailbox
	// TODO

	return true;
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
	if (!$TSunic->Config->get('email_enabled')) return false;

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
