<!-- | -->
<?php

function $$$editAccount () {
	global $TSunic;

	// get input
	$id_mail__account = $TSunic->Temp->getParameter('$$$formAccount__id_mail__account');
	$email = $TSunic->Temp->getPost('$$$formAccount__email');
	$password = $TSunic->Temp->getPost('$$$formAccount__password');
	$name = $TSunic->Temp->getPost('$$$formAccount__name');
	$description = $TSunic->Temp->getPost('$$$formAccount__description');
	$host = $TSunic->Temp->getPost('$$$formAccount__host');
	$port = $TSunic->Temp->getPost('$$$formAccount__port');
	$user = $TSunic->Temp->getPost('$$$formAccount__user');
	$protocol = $TSunic->Temp->getPost('$$$formAccount__protocol');
	$auth = $TSunic->Temp->getPost('$$$formAccount__auth');
	$connsecurity = $TSunic->Temp->getPost('$$$formAccount__connsecurity');

	// get new mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// validate input
	if (!$Mailaccount->isValidEmail($email)
			OR !$Mailaccount->isValidPassword($password)
			OR !$Mailaccount->isValidName($name)
			OR !$Mailaccount->isValidDescription($description)) {
		// invalid input
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// edit account
	$return = $Mailaccount->editAccount($email, $password, $name, $description);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{EDITACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// try to set connection
	$return = $Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity);

	// check for connection-errors
	if (!$return) {
		$TSunic->Log->add('error', '{EDITACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));
	}

	// success
	$TSunic->Log->add('info', '{EDITACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));

	return true;
}
?>
