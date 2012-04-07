<!-- | function to add new SMTP -->
<?php
function $$$addSmtp () {
	global $TSunic;

	// get input
	$fk_mail__account = $TSunic->Temp->getParameter('$$$formSmtp__mailaccount');
	$email = $TSunic->Temp->getParameter('$$$formSmtp__email');
	$password = $TSunic->Temp->getParameter('$$$formSmtp__password');
	$emailname = $TSunic->Temp->getParameter('$$$formSmtp__emailname');
	$description = $TSunic->Temp->getParameter('$$$formSmtp__description');
	$host = $TSunic->Temp->getParameter('$$$formSmtp__host');
	$port = $TSunic->Temp->getParameter('$$$formSmtp__port');
	$auth = $TSunic->Temp->getParameter('$$$formSmtp__auth');
	$connsecurity = $TSunic->Temp->getParameter('$$$formSmtp__connsecurity');
	$user = $TSunic->Temp->getParameter('$$$formSmtp__user');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp');

	// validate input
	if (!$Smtp->isValidEMail($email)
			OR !$Smtp->isValidPassword($password)
			OR !$Smtp->isValidDescription($description)
			OR !$Smtp->isValidEMailname($emailname)
	) {
		// invalid input
		$TSunic->Log->add('error', '{ADDSMTP__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create new smtp
	$return = $Smtp->createSmtp($email, $password, $description, $emailname);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDSMTP__ERROR}');
		$TSunic->redirect('back');
	}

	// add mailaccount
	if (!empty($fk_mail__account)) {
		$Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);
		if (!$Mailaccount OR !$Smtp->setMailaccount($Mailaccount)) {
			$TSunic->Log->add('error', '{ADDSMTP__ERROR}');
			$TSunic->redirect('back');
		}
	}

	// try to set connection
	$return = $Smtp->setConnection($host, $port, $user, $auth, $connsecurity);

	// check for connection-errors
	if (!$return) {
		$TSunic->Log->add('error', '{ADDSMTP__CONNERROR}', 3);
		$TSunic->redirect('$$$showEditSmtp', array('id_mail__smtp' => $Smtp->getInfo('id_mail__smtp')));
	}

	// success
	$TSunic->Log->add('info', '{ADDSMTP__SUCCESS}', 3);
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
