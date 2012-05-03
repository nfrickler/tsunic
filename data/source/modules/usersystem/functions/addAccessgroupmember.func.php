<!-- | FUNCTION add user to accessgroup -->
<?php
function $$$addAccessgroupmember () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getPost('$$$showAddAccessgroupmember__id');
	$fk_account = $TSunic->Temp->getPost('$$$showAddAccessgroupmember__user');

	// create accessgroup object
	$Accessgroup = $TSunic->get('$$$Accessgroup', $id);

	// add user to accessgroup
	$return = $Accessgroup->addMember($fk_account);

	// check, if create successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{ADDACCESSGROUPMEMBER__SUCCESS}', 3);
		$TSunic->redirect('$$$showAccessgroupmembers', array('$$$id' => $Accessgroup->getInfo('id')));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{ADDACCESSGROUPMEMBER__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
