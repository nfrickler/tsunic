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
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDREPEAT}');
		$TSunic->redirect('back');
	}

	// validate input
	if (!$TSunic->Usr->isValidName($name)) {
		// invalid name
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDNAME}');
		$TSunic->redirect('back');
	}
	if (!$TSunic->Usr->isValidEMail($email)) {
		// invalid email
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDEMAIL}');
		$TSunic->redirect('back');
	}
	if (!empty($password) AND !$TSunic->Usr->isValidPassword($password)) {
		// invalid email
		$TSunic->Log->alert('error', '{EDITACCOUNT__INVALIDPASSWORD}');
		$TSunic->redirect('back');
	}

	// edit account
	if ($TSunic->Usr->edit($email, $name, $password)) {
		// success
		$TSunic->Log->alert('info', '{EDITACCOUNT__SUCCESS}');
		$TSunic->redirect('$$$showAccount');
		return true;
	}

	// add error message and redirect back
	$TSunic->Log->alert('error', '{EDITACCOUNT__ERROR}');
	$TSunic->redirect('back');
	return true;
}
?>
