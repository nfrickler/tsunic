<!-- | FUNCTION show profile -->
<?php

function $$$showProfile () {
	global $TSunic;

	// activate template
	$data = array('User' => $TSunic->CurrentUser);
	$TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

	return true;
}
?>
