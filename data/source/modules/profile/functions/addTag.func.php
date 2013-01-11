<!-- | FUNCTION add tag to object -->
<?php
function $$$addTag () {
    global $TSunic;

    // get input
    $fk_obj = $TSunic->Temp->getPost('$$$formAddTag__fk_obj');
    $fk_tag = $TSunic->Temp->getPost('$$$formAddTag__fk_tag');

    // add tag to profile
    $Profile = $TSunic->get('$$$Profile', $fk_obj);

    // valid input?
    if (!$Profile->isValidFkTag($fk_tag)) {
	$TSunic->Log->alert('error', '{ADDTAG__INVALIDFKTYPE}');
	$TSunic->redirect('back');
    }

    // add tag to object
    if (!$Profile->addBit(true, $fk_tag)) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{ADDTAG__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{ADDTAG__SUCCESS}');
    $TSunic->redirect('$$$showEditProfile', array('$$$id' => $fk_obj));
    return true;
}
?>
