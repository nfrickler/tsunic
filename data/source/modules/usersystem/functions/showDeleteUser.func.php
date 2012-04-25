<!-- | FUNCTION show page to confirm user-deletion -->
<?php
function $$$showDeleteUser () {
	global $TSunic;

	// get User
	$id = $TSunic->Temp->getParameter('$$$id');
	$User = $TSunic->get('$$$User', $id);

	// activate template
	$data = array('User' => $User);
	$TSunic->Tmpl->activate('$$$showDeleteUser', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEUSER__TITLE}'));

	return true;
}
?>
