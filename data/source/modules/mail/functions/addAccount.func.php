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
		OR !$Mailaccount->isValidDescription($description)
	) {
		$TSunic->Log->alert('error', '{ADDACCOUNT__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create account
	if (!$Mailaccount->createAccount($email, $password, $name, $description)) {
		$TSunic->Log->alert('error', '{ADDACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// try to set connection
	if (!$Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
		$TSunic->Log->alert('error', '{ADDACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditAccount', array('$$$id' => $Mailaccount->getInfo('id')));
	}

	// success
	$TSunic->Log->alert('info', '{ADDACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('$$$id' => $Mailaccount->getInfo('id')));

	return true;
}
?>
