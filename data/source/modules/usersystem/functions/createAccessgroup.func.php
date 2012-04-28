<!-- | FUNCTION create accessgroup -->
<?php
function $$$createAccessgroup () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getPost('$$$formAccessgroup__name');
	$fk_parent = $TSunic->Temp->getPost('$$$formAccessgroup__parent');

	// create accessgroup object
	$Accessgroup = $TSunic->get('$$$Accessgroup', 0);

	// validate input
	if (!$Accessgroup->isValidName($name)) {
		// invalid name
		$TSunic->Log->add('error', '{CREATEACCESSGROUP__INVALIDNAME}', 3);
		$TSunic->redirect('back');
	}
	if (!$Accessgroup->isValidParent($fk_parent)) {
		// invalid fk_parent
		$TSunic->Log->add('error', '{CREATEACCESSGROUP__INVALIDPARENT}', 3);
		$TSunic->redirect('back');
	}

	// edit accessgroup
	$return = $Accessgroup->create($name, $fk_parent);

	// check, if create successful
	if ($return) {
		// success
		$TSunic->Log->add('info', '{CREATEACCESSGROUP__SUCCESS}', 3);
		$TSunic->redirect('$$$showAccessgroup');
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{CREATEACCESSGROUP__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>
