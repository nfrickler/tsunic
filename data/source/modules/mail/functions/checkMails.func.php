<!-- | function to check for new mails -->
<?php
function $$$checkMails () {
	global $TSunic;

	// get id_mail__box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');

	if (!empty($id_mail__box)) {
		// check only this mailserver for new mails
		// get mailbox-object
		$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

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
