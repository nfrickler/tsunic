<!-- | function to delete account -->
<?php
function $$$deleteAccount () {
	global $TSunic;

	// get password
	$password = $TSunic->Temp->getParameter('$$$showDeleteAccount__password');

	// validate password
	if (!$TSunic->CurrentUser->isPassword($password)) {
		// wrong password
		$TSunic->Log->add('error', '{DELETEACCOUNT__WRONGPASSWORD}');
		$TSunic->redirect('back');
	}

	// delete account and profile
	$return = $TSunic->CurrentUser->Account->delete();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// log out
	$TSunic->CurrentUser->doLogout();

	// delete cookies
	$TSunic->run('$system$resetAllCookies', false, true);

	// success
	$TSunic->Log->add('info', '{DELETEACCOUNT__SUCCESS}');

	// delete user
	$TSunic->CurrentUser->deleteUser();

	// redirect to showIndex
	$TSunic->redirect('default');
	return true;
}
?>
