<!-- | FUNCTION edit account-data -->
<?php

function $$$editAccount () {
	global $TSunic;

	// get input
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
	if (!empty($email) AND !$TSunic->CurrentUser->Account->isValidEMail($email)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDEMAIL}', 3);
		$TSunic->redirect('back');
	}
	if (!empty($password) AND !$TSunic->CurrentUser->Account->isValidPassword($password)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDPASSWORD}', 3);
		$TSunic->redirect('back');
	}

	// edit account
	$return = $TSunic->CurrentUser->Account->edit($email, $password);

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
