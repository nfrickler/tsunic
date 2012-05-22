<!-- | function to delete mail account -->
<?php
function $$$deleteAccount () {
	global $TSunic;

	// get mailaccount object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Account = $TSunic->get('$$$Account', $id);

	// delete account
	if (!$Account->deleteAccount()) {
		$TSunic->Log->alert('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{DELETEACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
