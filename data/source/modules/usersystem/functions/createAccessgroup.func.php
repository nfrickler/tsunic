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
		$TSunic->Log->alert('error', '{CREATEACCESSGROUP__INVALIDNAME}');
		$TSunic->redirect('back');
	}
	if (!$Accessgroup->isValidParent($fk_parent)) {
		// invalid fk_parent
		$TSunic->Log->alert('error', '{CREATEACCESSGROUP__INVALIDPARENT}');
		$TSunic->redirect('back');
	}

	// edit accessgroup
	$return = $Accessgroup->create($name, $fk_parent);

	// check, if create successful
	if ($return) {
		// success
		$TSunic->Log->alert('info', '{CREATEACCESSGROUP__SUCCESS}');
		$TSunic->redirect('$$$showAccessgroup', array('$$$id' => $Accessgroup->getInfo('id')));
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->alert('error', '{CREATEACCESSGROUP__ERROR}');
	$TSunic->redirect('back');
	return true;
}
?>
