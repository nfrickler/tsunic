<!-- | function to show main page -->
<?php
function $$$showMain () {
	global $TSunic;

	// activate template
	$data = array(0 => $TSunic->CurrentUser->getInfo('name'));
	$TSunic->Tmpl->activate('$$$showMain', '$$$content', $data);
	$TSunic->Tmpl->activate('$$$html', false, array('title' => '{SHOWMAIN__TITLE}'));

	return true;
}
?>
