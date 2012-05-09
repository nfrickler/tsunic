<!-- | FUNCTION edit filesystem directory -->
<?php
function $$$editFsDirectory () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getParameter('$$$formFsDirectory__id');
	$name = $TSunic->Temp->getPost('$$$formFsDirectory__name');
	$fk_parent = $TSunic->Temp->getPost('$$$formFsDirectory__parent');

	// edit directory object
	$Dir = $TSunic->get('$$$FsDirectory', $id);

	// validate input
	if (!$Dir->isValidName($name)) {
		// invalid name
		$TSunic->Log->add('error', '{EDITFSDIRECTORY__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$Dir->isValidParent($fk_parent)) {
		// invalid fk_parent
		$TSunic->Log->add('error', '{EDITFSDIRECTORY__INVALIDPARENT}', 3);
		$TSunic->redirect('back');
	}

	// edit directory
	$return = $Dir->edit($name, $fk_parent);

	// check, if edit successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{EDITFSDIRECTORY__SUCCESS}', 3);
		$TSunic->redirect('$$$showFsDirectory', array('$$$id' => $Dir->getInfo('id')));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{EDITFSDIRECTORY__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
