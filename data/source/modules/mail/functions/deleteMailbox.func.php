<!-- | function to delete mailbox -->
<?php
function $$$deleteMailbox () {
	global $TSunic;

	// get mailbox object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailbox = $TSunic->get('$$$Box', $id);

	// edit mailbox
	if (!$Mailbox->deleteBox()) {
		$TSunic->Log->alert('error', '{DELETEMAILBOX__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{DELETEMAILBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
