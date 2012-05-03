<!-- | FUNCTION delete member from accessgroup -->
<?php
function $$$deleteAccessgroupmember () {
	global $TSunic;

	// get accessgroup
	$id = $TSunic->Temp->getParameter('$$$id');
	$Accessgroup = $TSunic->get('$$$Accessgroup', $id);
	$userid = $TSunic->Temp->getParameter('$$$userid');

	// delete accessgroup
	if (!$Accessgroup->rmMember($userid)) {
		$TSunic->Log->add('error', '{DELETEACCESSGROUPMEMBER__ERROR}');
		$TSunic->redirect('back', 2);
		return false;
	}

	// success
	$TSunic->Log->add('info', '{DELETEACCESSGROUPMEMBER__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroupmembers', array('$$$id' => $id));
	return true;
}
?>
