<!-- | function to add new mailbox -->
<?php
function $$$addMailbox () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getParameter('$$$formMailbox__name');
	$description = $TSunic->Temp->getParameter('$$$formMailbox__description');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box');

	// create new mailbox
	$return = $Mailbox->createBox($name, $description);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDMAILBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{ADDMAILBOX__SUCCESS}', 3);
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
