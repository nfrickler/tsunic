<!-- | FUNCTION edit filesystem file -->
<?php
function $$$editFile () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getParameter('$$$formFile__id');

    // edit file object
    $File = $TSunic->get('$$$File', $id);
    $parent = $File->getInfo('parent');

    // get values
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    if (!$File->isValidName($form[0]['value'])) {
	// invalid name
	$TSunic->Log->alert('error', '{EDITFILE__INVALIDNAME}');
	$TSunic->redirect('back');
    }

    // save changes
    if (!$File->addeditBit($form[0]['fk_tag'], $form[0]['fk_bit'], $form[0]['value'])) {
	$TSunic->Log->alert('error', '{CREATEFILE__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{EDITFILE__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $parent));
    return true;
}
?>
