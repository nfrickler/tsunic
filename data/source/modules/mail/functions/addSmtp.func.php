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
		$TSunic->Log->alert('error', '{ADDSMTP__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create new smtp
	if (!$Smtp->createSmtp($email, $password, $description, $emailname)) {
		$TSunic->Log->alert('error', '{ADDSMTP__ERROR}');
		$TSunic->redirect('back');
	}

	// add mailaccount
	if (!empty($fk_mail__account)) {
		$Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);
		if (!$Mailaccount OR !$Smtp->setMailaccount($Mailaccount)) {
			$TSunic->Log->alert('error', '{ADDSMTP__ERROR}');
			$TSunic->redirect('back');
		}
	}

	// try to set connection
	if (!$Smtp->setConnection($host, $port, $user, $auth, $connsecurity)) {
		$TSunic->Log->alert('error', '{ADDSMTP__CONNERROR}');
		$TSunic->redirect('$$$showEditSmtp', array('$$$id' => $Smtp->getInfo('id')));
	}

	// success
	$TSunic->Log->alert('info', '{ADDSMTP__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
