<!-- | function to delete mail -->
<?php
function $$$deleteMail () {
	global $TSunic;

	// get input
	$id_mail__mail = $TSunic->Temp->getParameter('id_mail__mail');

	// get mailbox-object and fk_mail_box
	$Mail = $TSunic->get('$$$Mail', $id_mail__mail);
	$fk_mail__box = $Mail->getInfo('fk_mail__box');

	// edit mailbox
	$return = $Mail->deleteMail();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEMAIL__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETEMAIL__SUCCESS}');
	$TSunic->redirect('$$$showMailbox', array('id_mail__box' => $fk_mail__box));

	return true;
}
?>
