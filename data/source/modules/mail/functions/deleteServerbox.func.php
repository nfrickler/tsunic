<!-- | function to delete serverbox -->
<?php
function $$$deleteServerbox () {
	global $TSunic;

	// get serverbox object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Serverbox = $TSunic->get('$$$Serverbox', $id);

	// get id_mail__account
	$fk_mail__account = $Serverbox->getMailaccount(true);

	// delete serverbox
	if (!$Serverbox->deleteServerbox()) {
		$TSunic->Log->alert('error', '{DELETESERVERBOX__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{DELETESERVERBOX__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $fk_mail__account));

	return true;
}
?>
