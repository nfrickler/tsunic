<!-- | -->
<?php

function $$$deleteAccount () {
	global $TSunic;

	// get input
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get account-object
	$Account = $TSunic->get('$$$Account', $id_mail__account);

	// delete account
	$return = $Account->deleteAccount();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETEACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
