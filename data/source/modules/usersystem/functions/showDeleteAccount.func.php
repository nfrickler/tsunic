<!-- | FUNCTION show page to confirm account-deletion -->
<?php
function $$$showDeleteAccount () {
	global $TSunic;

	// activate template
	$data = array('User' => $TSunic->CurrentUser);
	$TSunic->Tmpl->activate('$$$showDeleteAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCOUNT__TITLE}'));

	return true;
}
?>
