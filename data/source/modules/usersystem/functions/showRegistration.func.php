<!-- | FUNCTION show registration-form -->
<?php
function $$$showRegistration () {
	global $TSunic;

	// activate template
	$TSunic->Tmpl->activate('$$$showRegistration', '$system$content');
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWREGISTRATION__TITLE}'));

	return true;
}
?>
