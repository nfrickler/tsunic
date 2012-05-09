<!-- | FUNCTION create filesystem directory -->
<?php
function $$$createFsDirectory () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getPost('$$$formFsDirectory__name');
	$fk_parent = $TSunic->Temp->getPost('$$$formFsDirectory__parent');

	// create directory object
	$Dir = $TSunic->get('$$$FsDirectory', 0);

	// validate input
	if (!$Dir->isValidName($name)) {
		// invalid name
		$TSunic->Log->add('error', '{CREATEFSDIRECTORY__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$Dir->isValidParent($fk_parent)) {
		// invalid fk_parent
		$TSunic->Log->add('error', '{CREATEFSDIRECTORY__INVALIDPARENT}', 3);
		$TSunic->redirect('back');
	}

	// create directory
	$return = $Dir->create($name, $fk_parent);

	// check, if create successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{CREATEFSDIRECTORY__SUCCESS}', 3);
		$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $Dir->getInfo('id')));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{CREATEFSDIRECTORY__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
