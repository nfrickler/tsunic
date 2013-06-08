<!-- | FUNCTION Register new user -->
<?php
function $$$doRegister () {
    global $TSunic;

    // get input
    $name = $TSunic->Input->post('$$$formAccount__name');
    $email = $TSunic->Input->post('$$$formAccount__email');
    $password = $TSunic->Input->postRaw('$$$formAccount__password');
    $passwordrepeat =
	$TSunic->Input->postRaw('$$$formAccount__passwordrepeat');

    // validate input
    if ($password != $passwordrepeat) {

	// password wrong repeated!
	$TSunic->Log->alert('error', '{DOREGISTER__INVALIDREPEAT}');

	// redirect back to form
	$TSunic->redirect('back');
    }
    if (!$TSunic->Usr->isValidEMail($email)) {

	// password wrong repeated!
	$TSunic->Log->alert('error', '{DOREGISTER__INVALIDEMAIL}');

	// redirect back to form
	$TSunic->redirect('back');
    }
    if (!$TSunic->Usr->isValidPassword($password)) {

	// password wrong repeated!
	$TSunic->Log->alert('error', '{DOREGISTER__INVALIDPASSWORD}');

	// redirect back to form
	$TSunic->redirect('back');
    }
    if (!$TSunic->Usr->isValidName($name)) {

	// password wrong repeated!
	$TSunic->Log->alert('error', '{DOREGISTER__INVALIDNAME}');

	// redirect back to form
	$TSunic->redirect('back');
    }

    // register user
    $return = $TSunic->Usr->create($email, $name, $password);

    // return
    if ($return) {

	// delete registration-data in Temp
	$TSunic->Input->reset();

	// set preset for login-form
	$expire = time() + 60 * 60 * 24 * 365;
	setCookie('$$$formLogin__emailname', $name, $expire);

	// success
	$TSunic->Log->alert('info', '{DOREGISTER__SUCCESS}');

	// show login
	$TSunic->redirect('$$$showLogin');
	exit;
    }

    // failed
    $TSunic->Log->alert('error', '{DOREGISTER__ERROR}');
    $TSunic->redirect('back');
    exit;
}
?>
