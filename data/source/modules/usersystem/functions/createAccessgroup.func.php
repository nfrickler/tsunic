<!-- | FUNCTION create accessgroup -->
<?php
function $$$createAccessgroup () {
    global $TSunic;

    // get input
    $data = array(
	'name' => $TSunic->Temp->getPost('$$$formAccessgroup__name'),
	'fk_parent' => $TSunic->Temp->getPost('$$$formAccessgroup__parent')
    );

    // create accessgroup object
    $Accessgroup = $TSunic->get('$$$Accessgroup');

    // validate input
    if (!$Accessgroup->isValidName($data['name'])) {
	// invalid name
	$TSunic->Log->alert('error', '{CREATEACCESSGROUP__INVALIDNAME}');
	$TSunic->redirect('back');
    }
    if (!$Accessgroup->isValidParent($data['fk_parent'])) {
	// invalid fk_parent
	$TSunic->Log->alert('error', '{CREATEACCESSGROUP__INVALIDPARENT}');
	$TSunic->redirect('back');
    }

    // set values
    if ($Accessgroup->setMulti($data, true)) {
	// success
	$TSunic->Log->alert('info', '{CREATEACCESSGROUP__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroups');
	return true;
    }

    // add error-message and redirect back
    $TSunic->Log->alert('error', '{CREATEACCESSGROUP__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
