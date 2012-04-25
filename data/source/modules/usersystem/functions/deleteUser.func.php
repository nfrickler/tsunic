<!-- | FUNCTION delete user -->
<?php
function $$$deleteUser () {
	global $TSunic;

	// get User
	$id = $TSunic->Temp->getParameter('$$$id');
	$User = $TSunic->get('$$$User', $id);

	// delete user
	if (!$User->delete()) {
		$TSunic->Log->add('error', '{DELETEUSER__ERROR}');
		$TSunic->redirect('back', 2);
		return false;
	}

	// success
	$TSunic->Log->add('info', '{DELETEUSER__SUCCESS}');
	$TSunic->redirect('$$$showUserlist');
	return true;
}
?>
