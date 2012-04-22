<!-- | FUNCTION show access -->
<?php
function $$$showAccess () {
	global $TSunic;

	# get account
	$fk_account = $TSunic->Temp->getParameter('fk_account');
	if (empty($fk_account)) $fk_account = $TSunic->Usr->getInfo('id');
	if (!$TSunic->Usr->access()) $fk_account = $TSunic->Usr->getInfo('id');

	// get user object
	if ($fk_account == $TSunic->Usr->getInfo('id')) {
		$User = $TSunic->Usr;
	} else {

		// check rights
		if (!$TSunic->Usr->access('$$$seeAllAccess')) {
			$TSunic->Log->add('{SHOWACCESS__PERMISSION_DENIED}', 3);
			$TSunic->redirect('back');
		}

		$User = $TSunic->get('$$$User', $fk_account);
	}

	// activate template
	$data = array('User' => $User);
	$TSunic->Tmpl->activate('$$$showAccess', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESS__TITLE}'));

	return true;
}
?>
