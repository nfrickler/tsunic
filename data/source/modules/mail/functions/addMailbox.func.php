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
	if (!$Mailbox->createBox($name, $description)) {
		$TSunic->Log->alert('error', '{ADDMAILBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{ADDMAILBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
