<!-- | FUNCTION edit accessgroup -->
<?php
function $$$editAccessgroup () {
    global $TSunic;

    // get input
    $id = $TSunic->Input->uint('$$$formAccessgroup__id');
    $data = array(
	'name' => $TSunic->Input->post('$$$formAccessgroup__name'),
	'fk_parent' => $TSunic->Input->uint('$$$formAccessgroup__parent')
    );

    // create accessgroup object
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    if (!$Accessgroup->isValid()) {
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDGROUP}');
	$TSunic->redirect('back');
    }

    // validate input
    if (!$Accessgroup->isValidName($data['name'])) {
	// invalid name
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Accessgroup->isValidParent($data['fk_parent'])) {
	// invalid fk_parent
	$TSunic->Log->alert('error', '{EDITACCESSGROUP__INVALIDPARENT}');
	$TSunic->redirect('back');
    }

    // edit accessgroup
    if ($Accessgroup->setMulti($data, true)) {
	// success
	$TSunic->Log->alert('info', '{EDITACCESSGROUP__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroups');
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{EDITACCESSGROUP__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
