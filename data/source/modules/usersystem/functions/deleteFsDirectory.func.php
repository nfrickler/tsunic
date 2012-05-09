<!-- | FUNCTION delete directory -->
<?php
function $$$deleteFsDirectory () {
	global $TSunic;

	// get directory
	$id = $TSunic->Temp->getParameter('$$$id');
	$Directory = $TSunic->get('$$$FsDirectory', $id);
	$fk_parent = $Directory->getInfo('fk_parent');

	// delete directory
	if (!$Directory->delete()) {
		$TSunic->Log->add('error', '{DELETEFSDIRECTORY__ERROR}');
		$TSunic->redirect('back', 2);
		return false;
	}

	// success
	$TSunic->Log->add('info', '{DELETEFSDIRECTORY__SUCCESS}');
	$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $fk_parent));
	return true;
}
?>
