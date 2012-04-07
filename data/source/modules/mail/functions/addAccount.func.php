<!-- | function to add new mail account -->
<?php
function $$$addAccount () {
	global $TSunic;

	// get input
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
	$Mailaccount = $TSunic->get('$$$Account');

	// validate input
	if (!$Mailaccount->isValidEmail($email)
			OR !$Mailaccount->isValidPassword($password)
			OR !$Mailaccount->isValidName($name)
			OR !$Mailaccount->isValidDescription($description)) {
		// invalid input
		$TSunic->Log->add('error', '{ADDACCOUNT__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// create account
	$return = $Mailaccount->createAccount($email, $password, $name, $description);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDACCOUNT__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// try to set connection
	$return = $Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity);

	// check for connection-errors
	if (!$return) {
		$TSunic->Log->add('error', '{ADDACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));
	}

	// success
	$TSunic->Log->add('info', '{ADDACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));

	return true;
}
?>
