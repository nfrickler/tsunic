<!-- | FUNCTION show page to edit account -->
<?php
function $$$showEditAccount () {
	global $TSunic;

	// activate template
	$data = array('User' => $TSunic->Usr);
	$TSunic->Tmpl->activate('$$$showEditAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITACCOUNT__TITLE}'));

	return true;
}
?>
