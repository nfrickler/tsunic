<!-- | function to delete mail account -->
<?php
function $$$deleteMailaccount () {
	global $TSunic;

	// get mailaccount object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

	// delete mailaccount
	if (!$Mailaccount->delete()) {
		$TSunic->Log->alert('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{DELETEACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
