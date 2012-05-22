<!-- | function to delete mail -->
<?php
function $$$deleteMail () {
	global $TSunic;

	// get mailbox-object and fk_mail_box
	$id = $TSunic->Temp->getParameter('id');
	$Mail = $TSunic->get('$$$Mail', $id);
	$fk_mail__box = $Mail->getInfo('fk_mail__box');

	// edit mailbox
	if (!$Mail->deleteMail()) {
		$TSunic->Log->alert('error', '{DELETEMAIL__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{DELETEMAIL__SUCCESS}');
	$TSunic->redirect('$$$showMailbox', array('$$$id' => $fk_mail__box));

	return true;
}
?>
