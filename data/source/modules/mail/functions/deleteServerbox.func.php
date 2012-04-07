<!-- | function to delete serverbox -->
<?php
function $$$deleteServerbox () {
	global $TSunic;

	// get input
	$id_mail__serverbox = $TSunic->Temp->getParameter('id_mail__serverbox');

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id_mail__serverbox);

	// get id_mail__account
	$fk_mail__account = $Serverbox->getMailaccount(true);

	// delete serverbox
	$return = $Serverbox->deleteServerbox();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETESERVERBOX__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETESERVERBOX__SUCCESS}', 3);
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $fk_mail__account));

	return true;
}
?>
