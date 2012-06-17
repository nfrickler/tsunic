<!-- | FUNCTION edit accessgroup -->
<?php
function $$$editAccessgroup () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getParameter('$$$formAccessgroup__id');
    $name = $TSunic->Temp->getPost('$$$formAccessgroup__name');
    $fk_parent = $TSunic->Temp->getPost('$$$formAccessgroup__parent');

    // create accessgroup object
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    if (!$Accessgroup->isValid()) {
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDGROUP}');
	$TSunic->redirect('back');
    }

    // validate input
    if (!$Accessgroup->isValidName($name)) {
	// invalid name
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Accessgroup->isValidParent($fk_parent)) {
	// invalid fk_parent
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDPARENT}');
	$TSunic->redirect('back');
    }

    // edit accessgroup
    if ($Accessgroup->edit($name, $fk_parent)) {
	// success
	$TSunic->Log->alert('info', '{EDITACCESSGROUP__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroup', array('$$$id' => $id));
	return true;
    }

    // add error-message and redirect back
    $TSunic->Log->alert('error', '{EDITACCESSGROUP__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
