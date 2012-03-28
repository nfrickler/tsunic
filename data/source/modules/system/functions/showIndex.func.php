<!-- | function to show index-page (default startup-page) -->
<?php

function $$$showIndex () {
	global $TSunic;

	// redirect to usersystem
	$TSunic->redirect('$usersystem$showIndex');

	return true;
}
?>
