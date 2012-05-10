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
		$TSunic->Log->add('error', '{EDITFSFILE__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$File->isValidDirectory($fk_directory)) {
		// invalid fk_directory
		$TSunic->Log->add('error', '{EDITFSFILE__INVALIDPARENT}', 3);
		$TSunic->redirect('back');
	}

	// edit file
	$return = $File->edit($name, $fk_directory);

	// check, if edit successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{EDITFSFILE__SUCCESS}', 3);
		$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $fk_dir));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{EDITFSFILE__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
