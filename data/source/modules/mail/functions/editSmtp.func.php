<!-- | -->
<?php

function $$$editSmtp () {
	global $TSunic;

	// get input
	$id_mail__smtp = $TSunic->Temp->getParameter('$$$formSmtp__id_mail__smtp');
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
	$Smtp = $TSunic->get('$$$Smtp', $id_mail__smtp);

	// validate input
	if (!$Smtp->isValidEMail($email)
			OR !$Smtp->isValidPassword($password)
			OR !$Smtp->isValidDescription($description)
			OR !$Smtp->isValidEMailname($emailname)
			OR !$Smtp->isValidHost($host)
			OR !$Smtp->isValidPort($port)
			OR !$Smtp->isValidAuth($auth)
			OR !$Smtp->isValidConnsecurity($connsecurity)
	) {
		// invalid input
		$TSunic->Log->add('error', '{EDITSMTP__INVALIDINPUT}');
		$TSunic->redirect('back');	
	}

	// edit smtp
	$return = $Smtp->editSmtp($email, $password, $description, $emailname);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{EDITSMTP__ERROR}');
		$TSunic->redirect('back');
	}

	// update mailaccount
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
		$TSunic->Log->add('error', '{EDITSMTP__CONNERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{EDITSMTP__SUCCESS}');
	$TSunic->redirect('back', 2);

	return true;
}
?>
