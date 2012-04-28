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

	// validate input
	if (!$Accessgroup->isValidName($name)) {
		// invalid name
		$TSunic->Log->add('error', '{EDITACCESSGROUP__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$Accessgroup->isValidParent($fk_parent)) {
		// invalid fk_parent
		$TSunic->Log->add('error', '{EDITACCESSGROUP__INVALIDPARENT}', 3);
		$TSunic->redirect('back');
	}

	// edit accessgroup
	$return = $Accessgroup->edit($name, $fk_parent);

	// check, if edit successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{EDITACCESSGROUP__SUCCESS}', 3);
		$TSunic->redirect('$$$showAccount');
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{EDITACCESSGROUP__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
