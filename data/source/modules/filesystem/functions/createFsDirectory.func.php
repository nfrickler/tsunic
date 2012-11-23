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
	$TSunic->Log->alert('error', '{CREATEFSDIRECTORY__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Dir->isValidParent($fk_parent)) {
	// invalid fk_parent
	$TSunic->Log->alert('error', '{CREATEFSDIRECTORY__INVALIDPARENT}');
	$TSunic->redirect('back');
    }

    // create directory
    $return = $Dir->create($name, $fk_parent);

    // check, if create successful
    if ($return) {
	// success
	$TSunic->Log->alert('info', '{CREATEFSDIRECTORY__SUCCESS}');
	$TSunic->redirect('$$$showIndex', array('$$$id' => $Dir->getInfo('id')));
	return true;
    }

    // add error-message and redirect back
    $TSunic->Log->alert('error', '{CREATEFSDIRECTORY__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
