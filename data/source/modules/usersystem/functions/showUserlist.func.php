<!-- | FUNCTION show userlist -->
<?php
function $$$showUserlist () {
	global $TSunic;

	// get all users
	$users = array();
	$all_users = $TSunic->Usr->allUsers();
	foreach ($all_users as $id => $name) {
		$users[] = $TSunic->get('$$$User', $id);
	}

	// activate template
	$data = array('users' => $users);
	$TSunic->Tmpl->activate('$$$showUserlist', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWUSERLIST__TITLE}'));

	return true;
}
?>
