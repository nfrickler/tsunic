<!-- | function to set language -->
<?php
function $$$setLanguage () {
	global $TSunic;

	// get language
	$lang = $TSunic->Temp->getParameter('lang');

	// set runtime-variable
	$TSunic->Config->setRuntime('language', $lang);

	// redirect back
	$TSunic->redirect('back');

	return true;
}
?>
