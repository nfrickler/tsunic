<!-- | function to check for new mails -->
<?php
function $$$checkMails () {
	global $TSunic;

	// get id
	$id = $TSunic->Temp->getParameter('$$$id');

	if (!empty($id)) {
		// check only this mailserver for new mails
		// get mailbox-object
		$Mailbox = $TSunic->get('$$$Box', $id);

		// check for new mails
		$Mailbox->checkMails();
	} else {
		// check all mailboxes for new mails
		// get SuperEMail-object
		$SuperMail = $TSunic->get('$$$SuperMail');

		// check for new mails
		$SuperMail->checkMails();
	}

	return true;
}
?>
