<!-- | FUNCTION create filesystem file -->
<?php
function $$$createFile () {
    global $TSunic;

    // get input
    $parent_preset = $TSunic->Temp->getPost('$$$formFile__parent_preset');

    // create file object
    $File = $TSunic->get('$$$File', 0);

    // validate input
    if (!$File->isValidFilesize($_FILES['$$$formFile__file']['size'])) {
	$TSunic->Log->alert('error', '{CREATEFILE__INVALIDFILESIZE}');
	$TSunic->redirect('back');
    }
    if (!$File->isValidQuota($_FILES['$$$formFile__file']['size'])) {
	$TSunic->Log->alert('error', '{CREATEFILE__INVALIDQUOTA}');
	$TSunic->redirect('back');
    }

    // create file
    if (!$File->createByUpload($_FILES['$$$formFile__file'])) {
	$TSunic->Log->alert('error', '{CREATEFILE__ERROR}');
	$TSunic->redirect('back');
    }

    // get values
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // set parent_preset
    if (!$File->addeditBit('FILE__PARENT', 0, $parent_preset)) {
	$TSunic->Log->alert('error', '{CREATEFILE__ERROR}');
	$TSunic->redirect('back');
    }

    // set filename?
    if (!empty($form[0]['value']) and !$File->addeditBit('FILE__NAME', 0, $form[0]['value'])) {
	$TSunic->Log->alert('error', '{CREATEFILE__ERROR}');
	$TSunic->redirect('back');
    }

    // add error message and redirect back
    $TSunic->Log->alert('info', '{CREATEFILE__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $File->getInfo('parent')));
    return true;
}
?>
