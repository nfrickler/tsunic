<!-- | function to edit mail account -->
<?php
function $$$editAccount () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getParameter('$$$formAccount__id_mail__account');
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
	$Mailaccount = $TSunic->get('$$$Account', $id);

	// validate input
	if (!$Mailaccount->isValidEmail($email)
			OR !$Mailaccount->isValidPassword($password)
			OR !$Mailaccount->isValidName($name)
			OR !$Mailaccount->isValidDescription($description)
	) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// edit account
	if (!$Mailaccount->editAccount($email, $password, $name, $description)) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// try to set connection
	if (!$Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditAccount', array('$$$id' => $Mailaccount->getInfo('id')));
	}

	// success
	$TSunic->Log->alert('info', '{EDITACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('$$$id' => $Mailaccount->getInfo('id')));

	return true;
}
?>
