<!-- | CLASS Local mail sender -->
<?php
/** Pseudo Smtp object to handle local sends
 *
 * Via this Smtp object mails can be send locally
 */
class $$$SmtpLocal extends $$$Smtp {

    /** Get default value for specific field
     * @param string $name
     *	Name of field
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

    /** Get name of this object
     *
     * @return string
     */
    public function getName () {
	$name = $this->getInfo('emailname');
	$name .= " {CLASS__SMTPLOCAL__NAME}";
	return $name;
    }

    /** Create new Smtp server
     * @param string $email
     *	E-mail address
     * @param string $password
     *	Password
     * @param string $description
     *	Description
     * @param string $emailname
     *	E-mail-name
     *
     * @return bool
     */
    public function create ($email, $password, $description = false, $emailname = false) {
	return false;
    }

    /** Edit Smtp server
     * @param string $email
     *	E-mail-address
     * @param string $password
     *	Password
     * @param string $description
     *	Description
     * @param string $emailname
     *	E-mail-name
     *
     * @return bool
     */
    public function edit ($email, $password, $description = '', $emailname = '') {
	return false;
    }

    /** Disable deletion
     *
     * @return bool
     */
    public function delete () {
	return false;
    }

    /** This object is always valid
     *
     * @return bool
     */
    public function isValid () {
	return true;
    }

    /** Send mail (either intern or extern)
     * @param Mail $Mail
     *	Mail object to be send
     * @param string $addressee
     *	Addressee
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

    /** Send mail internally to other user
     * @param Mail $Mail
     *	Mail object to be send
     * @param string $addressee
     *	Addressee
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

    /** Send mail via PHP mail function to specified e-mail address
     * @param Mail $Mail
     *	Mail object to be send
     * @param string $addressee
     *	Addressee
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
