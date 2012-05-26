<!-- | function to edit mailbox -->
<?php
function $$$editMailbox () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getPost('$$$formMailbox__id');
	$name = $TSunic->Temp->getPost('$$$formMailbox__name');
	$description = $TSunic->Temp->getPost('$$$formMailbox__description');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box', $id);

	// edit mailbox
	if (!$Mailbox->editBox($name, $description)) {
		$TSunic->Log->alert('error', '{EDITMAILBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{EDITMAILBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
