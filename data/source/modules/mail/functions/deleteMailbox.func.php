<!-- | function to delete mailbox -->
<?php
function $$$deleteMailbox () {
	global $TSunic;

	// get input
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

	// edit mailbox
	$return = $Mailbox->deleteBox();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEMAILBOX__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETEMAILBOX__SUCCESS}', 3);
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
