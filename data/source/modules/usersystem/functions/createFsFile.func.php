<!-- | FUNCTION create filesystem file -->
<?php
function $$$createFsFile () {
	global $TSunic;

	// get input
	$fk_directory = $TSunic->Temp->getPost('$$$formFsFile__directory');

	// create file object
	$File = $TSunic->get('$$$FsFile', 0);

	// validate input
	if (!$File->isValidFilesize($_FILES['$$$formFsFile__file']['size'])) {
		$TSunic->Log->add('error', '{CREATEFSFILE__INVALIDFILESIZE}', 3);
		$TSunic->redirect('back');
	}
	if (!$File->isValidQuota($_FILES['$$$formFsFile__file']['size'])) {
		$TSunic->Log->add('error', '{CREATEFSFILE__INVALIDQUOTA}', 3);
		$TSunic->redirect('back');
	}
	if (!$File->isValidDirectory($fk_directory)) {
		$TSunic->Log->add('error', '{CREATEFSFILE__INVALIDDIRECTORY}', 3);
		$TSunic->redirect('back');
	}

	// create file
	$return = $File->create($_FILES['$$$formFsFile__file'], $fk_directory);

	// check, if create successful
	if ($return) {
		$TSunic->Log->add('info', '{CREATEFSFILE__SUCCESS}', 3);
		$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $File->getInfo('fk_directory')));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{CREATEFSFILE__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
