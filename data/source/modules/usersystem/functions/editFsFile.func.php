<!-- | FUNCTION edit filesystem file -->
<?php
function $$$editFsFile () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getParameter('$$$formFsFile__id');
	$name = $TSunic->Temp->getPost('$$$formFsFile__name');
	$fk_directory = $TSunic->Temp->getPost('$$$formFsFile__directory');

	// edit file object
	$File = $TSunic->get('$$$FsFile', $id);
	$fk_dir = $File->getInfo('fk_directory');

	// validate input
	if (!$File->isValidName($name)) {
		// invalid name
		$TSunic->Log->alert('error', '{EDITFSFILE__INVALIDNAME}');
		$TSunic->redirect('back');
	}
	if (!$File->isValidDirectory($fk_directory)) {
		// invalid fk_directory
		$TSunic->Log->alert('error', '{EDITFSFILE__INVALIDPARENT}');
		$TSunic->redirect('back');
	}

	// edit file
	$return = $File->edit($name, $fk_directory);

	// check, if edit successful
	if ($return) {
		// success
		$TSunic->Log->alert('info', '{EDITFSFILE__SUCCESS}');
		$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $fk_dir));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->alert('error', '{EDITFSFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
}
?>
