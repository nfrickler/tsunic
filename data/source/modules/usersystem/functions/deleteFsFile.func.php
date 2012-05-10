<!-- | FUNCTION delete file -->
<?php
function $$$deleteFsFile () {
	global $TSunic;

	// get file
	$id = $TSunic->Temp->getParameter('$$$id');
	$File = $TSunic->get('$$$FsFile', $id);
	$fk_directory = $File->getInfo('fk_directory');

	// delete file
	if (!$File->delete()) {
		$TSunic->Log->add('error', '{DELETEFSFILE__ERROR}');
		$TSunic->redirect('back', 2);
		return false;
	}

	// success
	$TSunic->Log->add('info', '{DELETEFSFILE__SUCCESS}');
	$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $fk_directory));
	return true;
}
?>
