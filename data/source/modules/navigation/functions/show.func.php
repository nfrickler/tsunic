<!-- | -->
<?php

function $$$show () {
	global $TSunic;

	// try to run showSystemNavigation-function of module
	$return = $TSunic->run($TSunic->Temp->getModule().'___showSystemNavigation', false, true);

	// check, if navigation exists
	$TSunic->Tmpl->activate($TSunic->Temp->getModule().'___system_navigation', '$$$show');

	return true;
}
?>
