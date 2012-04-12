<!-- | FUNCTION show registration-form -->
<?php
function $$$showRegistration () {
	global $TSunic;

	// activate template
	$data = array('User' => $TSunic->Usr);
	$TSunic->Tmpl->activate('$$$showRegistration', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWREGISTRATION__TITLE}'));

	return true;
}
?>
