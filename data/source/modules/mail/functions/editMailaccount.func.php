<!-- | function to edit mail account -->
<?php
function $$$editMailaccount () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getParameter('$$$formMailaccount__id_mail__account');
	$email = $TSunic->Temp->getPost('$$$formMailaccount__email');
	$password = $TSunic->Temp->getPost('$$$formMailaccount__password');
	$name = $TSunic->Temp->getPost('$$$formMailaccount__name');
	$description = $TSunic->Temp->getPost('$$$formMailaccount__description');
	$host = $TSunic->Temp->getPost('$$$formMailaccount__host');
	$port = $TSunic->Temp->getPost('$$$formMailaccount__port');
	$user = $TSunic->Temp->getPost('$$$formMailaccount__user');
	$protocol = $TSunic->Temp->getPost('$$$formMailaccount__protocol');
	$auth = $TSunic->Temp->getPost('$$$formMailaccount__auth');
	$connsecurity = $TSunic->Temp->getPost('$$$formMailaccount__connsecurity');

	// get new mailaccount object
	$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

	// validate input
	if (!$Mailaccount->isValidEmail($email)
		OR !$Mailaccount->isValidPassword($password)
		OR !$Mailaccount->isValidName($name)
		OR !$Mailaccount->isValidDescription($description)
	) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// edit mailaccount
	if (!$Mailaccount->edit($email, $password, $name, $description)) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// try to set connection
	if (!$Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity)) {
		$TSunic->Log->alert('error', '{EDITACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));
	}

	// success
	$TSunic->Log->alert('info', '{EDITACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showMailaccount', array('$$$id' => $Mailaccount->getInfo('id')));

	return true;
}
?>
