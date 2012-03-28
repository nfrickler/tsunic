<!-- | -->
<?php

function $$$editMailbox () {
	global $TSunic;

	// get input
	$id_mail__box = $TSunic->Temp->getPost('$$$formMailbox__id_mail__box');
	$name = $TSunic->Temp->getPost('$$$formMailbox__name');
	$description = $TSunic->Temp->getPost('$$$formMailbox__description');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

	// edit mailbox
	$return = $Mailbox->editBox($name, $description);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{EDITMAILBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{EDITMAILBOX__SUCCESS}', 3);
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
