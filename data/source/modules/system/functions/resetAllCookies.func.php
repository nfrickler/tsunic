<!-- | function to reset all cookies -->
<?php

function $$$resetAllCookies () {
	global $TSunic;

	// delete all cookies
	foreach ($_COOKIE as $index => $value) {
		// delete cookie
		setcookie ($index, "", time() - 3600);
	}

	// add info-message
	$TSunic->Log->add('info', '{RESETALLCOOKIES_INFO}', 3);

	// redirect back
	$TSunic->redirect('back');
	exit;
}
?>
