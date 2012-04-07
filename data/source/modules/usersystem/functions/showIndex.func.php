<!-- | function to show main page -->
<?php
function $$$showIndex () {
	global $TSunic;

	// activate template
	$TSunic->Tmpl->activate('$$$showIndex', '$system$content');
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

	return true;
}
?>
