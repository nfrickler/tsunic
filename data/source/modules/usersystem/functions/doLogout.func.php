<!-- | FUNCTION logout user -->
<?php
function $$$doLogout () {
	global $TSunic;

	// do logout
	$return = $TSunic->Usr->logout();

	// add info-message
	$TSunic->Log->add('info', '{DOLOGOUT__SUCCESS}', 3);

	// redirect to login-page
	$TSunic->redirect('$$$showIndex');
	exit;
}
?>
