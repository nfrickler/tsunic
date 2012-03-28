<!-- | -->
<?php

function $$$showLogin () {
	global $TSunic;

	// activate template
	$TSunic->Tmpl->activate('$$$showLogin', '$system$content');
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWLOGIN__TITLE}'));

	return true;
}
?>
