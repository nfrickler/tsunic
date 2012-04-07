<!-- | login user -->
<?php
function $$$doLogin () {
	global $TSunic;

	// set preset for login-form
	$expire = time() + 60 * 60 * 24 * 365;
	setCookie('$$$formLogin__emailname', $TSunic->Temp->getPost('$$$formLogin__emailname'), $expire);

	// do login
	$return = $TSunic->CurrentUser->doLogin($TSunic->Temp->getPost('$$$formLogin__emailname'),
		$TSunic->Temp->getPost('$$$formLogin__password'));

	// check, if login was successfull
	if ($return === true) {

		// success
		$TSunic->Log->add('info', '{DOLOGIN__SUCCESS}', 3);

		// redirect to showMain
		$TSunic->redirect('$system$showMain');
	} else {

		// login failed
		$TSunic->Log->add('error', '{DOLOGIN__FAILED}', 3);

		// return to login-page
		$TSunic->redirect('$$$showIndex');
	}

	exit;
}
?>
