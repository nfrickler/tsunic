<!-- | FUNCTION logout user -->
<?php
function $$$doLogout () {
	global $TSunic;

	// do logout
	$return = $TSunic->Usr->logout();

	// add info-message
	$TSunic->Log->alert('info', '{DOLOGOUT__SUCCESS}');

	// redirect to login-page
	$TSunic->redirect('$$$showIndex');
	exit;
}
?>
