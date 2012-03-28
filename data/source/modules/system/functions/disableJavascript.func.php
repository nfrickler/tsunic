<!-- | function to disable javascript -->
<?php

function $$$disableJavascript () {
	global $TSunic;

	// set runtime-variable
	$TSunic->Config->setRuntime('javascript', 'off');

	// redirect back
	$TSunic->redirect('back');
	return true;
}
?>
