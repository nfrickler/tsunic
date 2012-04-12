<!-- | FUNCTION edit account-data -->
<?php
function $$$editAccount () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getPost('$$$formAccount__name');
	$email = $TSunic->Temp->getPost('$$$formAccount__email');
	$password = $TSunic->Temp->getPost('$$$formAccount__password');
	$passwordrepeat = $TSunic->Temp->getPost('$$$formAccount__passwordrepeat');

	// check, if password-repeat correct
	if ($password != $passwordrepeat) {
		// invalid repeat
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDREPEAT}', 3);
		$TSunic->redirect('back');
	}

	// validate input
	if (!$TSunic->Usr->isValidName($name)) {
		// invalid name
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$TSunic->Usr->isValidEMail($email)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDEMAIL}', 3);
		$TSunic->redirect('back');
	}
	if (!empty($password) AND !$TSunic->Usr->isValidPassword($password)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDPASSWORD}', 3);
		$TSunic->redirect('back');
	}

	// edit account
	$return = $TSunic->Usr->edit($email, $name, $password);

	// check, if edit successful
	if ($return) {
		// success
		// create info-message and redirect
		$TSunic->Log->add('info', '{EDITACCOUNT__SUCCESS}', 3);
		$TSunic->redirect('$$$showAccount');
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{EDITACCOUNT__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
