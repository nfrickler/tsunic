<!-- | FUNCTION delete account -->
<?php
function $$$deleteAccount () {
	global $TSunic;

	// get password
	$password = $TSunic->Temp->getParameter('$$$showDeleteAccount__password');

	// validate password
	if (!$TSunic->Usr->isCorrectPassword($password)) {
		// wrong password
		$TSunic->Log->add('error', '{DELETEACCOUNT__WRONGPASSWORD}');
		$TSunic->redirect('back');
	}

	// delete cookies
	//$TSunic->run('$system$resetAllCookies', false, true);

	// delete user
	$return = $TSunic->Usr->delete();
	$TSunic->Usr->logout();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETEACCOUNT__SUCCESS}');

	// redirect to showIndex
	$TSunic->redirect('default');
	return true;
}
?>
