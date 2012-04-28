<!-- | FUNCTION show list of accessgroups -->
<?php
function $$$showAccessgroups () {
	global $TSunic;

	// activate template
	$TSunic->Tmpl->activate('$$$showAccessgroups', '$system$content');
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESSGROUPS__TITLE}'));

	return true;
}
?>
