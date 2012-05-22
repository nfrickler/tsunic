<!-- | FUNCTION delete accessgroup -->
<?php
function $$$deleteAccessgroup () {
	global $TSunic;

	// get accessgroup
	$id = $TSunic->Temp->getParameter('$$$id');
	$Accessgroup = $TSunic->get('$$$Accessgroup', $id);

	// delete accessgroup
	if (!$Accessgroup->delete()) {
		$TSunic->Log->alert('error', '{DELETEACCESSGROUP__ERROR}');
		$TSunic->redirect('back', 2);
		return false;
	}

	// success
	$TSunic->Log->alert('info', '{DELETEACCESSGROUP__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroups');
	return true;
}
?>
