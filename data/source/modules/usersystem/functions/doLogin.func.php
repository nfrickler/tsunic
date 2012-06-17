<!-- | FUNCTION login user -->
<?php
function $$$doLogin () {
    global $TSunic;

    // set preset for login-form
    $expire = time() + 60 * 60 * 24 * 365;
    setCookie('$$$formLogin__emailname', $TSunic->Temp->getPost('$$$formLogin__emailname'), $expire);

    // do login
    $return = $TSunic->Usr->login(
	$TSunic->Temp->getPost('$$$formLogin__emailname'),
	$TSunic->Temp->getPost('$$$formLogin__password')
    );

    // check, if login was successfull
    if ($return === true) {

	// success
	$TSunic->Log->alert('info', '{DOLOGIN__SUCCESS}');

	// redirect to showMain
	$TSunic->redirect('$system$showMain');
    } else {

	// login failed
	$TSunic->Log->alert('error', '{DOLOGIN__FAILED}');

	// return to login-page
	$TSunic->redirect('$$$showIndex');
    }

    exit;
}
?>
