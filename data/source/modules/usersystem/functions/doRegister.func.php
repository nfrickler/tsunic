<!-- | FUNCTION Register new user -->
<?php
function $$$doRegister () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getPost('$$$formAccount__name');
	$email = $TSunic->Temp->getPost('$$$formAccount__email');
	$password = $TSunic->Temp->getPost('$$$formAccount__password');
	$passwordrepeat = $TSunic->Temp->getPost('$$$formAccount__passwordrepeat');

	// validate input
	if ($password != $passwordrepeat) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDREPEAT}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$TSunic->Usr->isValidEMail($email)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDEMAIL}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$TSunic->Usr->isValidPassword($password)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDPASSWORD}');

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$TSunic->Usr->isValidName($name)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDNAME}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}

	// register user
	$return = $TSunic->Usr->create($email, $name, $password);

	// return
	if ($return) {

		// delete registration-data in Temp
		$TSunic->Temp->reset();

		// set preset for login-form
		$expire = time() + 60 * 60 * 24 * 365;
		setCookie('$$$formLogin__emailname', $name, $expire);

		// success
		$TSunic->Log->add('info', '{DOREGISTER__SUCCESS}', 3);

		// show login
		$TSunic->redirect('$$$showLogin');
		exit;
	}

	// failed
	$TSunic->Log->add('error', '{DOREGISTER__ERROR}', 3);
	$TSunic->redirect('back');
	exit;
}
?>
