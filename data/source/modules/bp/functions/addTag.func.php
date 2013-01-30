<!-- | FUNCTION add tag to object -->
<?php
function $$$addTag () {
    global $TSunic;

    // get input
    $fk_obj = $TSunic->Temp->getPost('$$$formAddTag__fk_obj');
    $fk_tag = $TSunic->Temp->getPost('$$$formAddTag__fk_tag');
    $backlink = base64_decode($TSunic->Temp->getPost('$$$formAddTag__backlink'));
    if (!$backlink) $backlink = '?back=2';

    // add tag to profile
    $Obj = $TSunic->get('$$$BpObject', $fk_obj);
    $Obj = $Obj->getObject();
    if (!$Obj) {
	$TSunic->Log->alert('error', '{ADDTAG__ERROR}');
	$TSunic->redirect('back');
    }

    // valid input?
    if (!$Obj->isValidFkTag($fk_tag)) {
	$TSunic->Log->alert('error', '{ADDTAG__INVALIDFKTYPE}');
	$TSunic->redirect('back');
    }

    // add tag to object
    if (!$Obj->addBit(true, $fk_tag)) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{ADDTAG__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{ADDTAG__SUCCESS}');
    $TSunic->redirect($backlink, true);
    return true;
}
?>
