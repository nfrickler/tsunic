<!-- | function to enable javascript -->
<?php
function $$$enableJavascript () {
	global $TSunic;

	// set runtime-variable
	$TSunic->Usr->setConfig('$$$javascript', 'on');

	// redirect back
	$TSunic->redirect('back');
	return true;
}
?>
