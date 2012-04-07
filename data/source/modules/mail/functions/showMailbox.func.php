<!-- | function to show mailbox -->
<?php
function $$$showMailbox () {
	global $TSunic;

	// get id_mail__box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');
	if (!is_numeric($id_mail__box)) $id_mail__box = 0;

	// get MailBox-object
	$Mailbox = ($id_mail__box == 0) ? $TSunic->get('$$$Inbox') : $TSunic->get('$$$Box', $id_mail__box);

	// get mailboxes
	$Supermail = $TSunic->get('$$$SuperMail');
	$mailboxes = $Supermail->getMailboxes();
	foreach ($mailboxes as $index => $Value) {
		if ($Value->getInfo('id_mail__box') == $id_mail__box) {
			unset($mailboxes[$index]);
			break;
		}
	}

	// check for new mails
	if (!$TSunic->isJavascript()) $Mailbox->checkMails();

	// activate template
	$data = array(
		'Mailbox' => $Mailbox,
		'mailboxes' => $mailboxes
	);
	$TSunic->Tmpl->activate('$$$showMailbox', '$system$content', $data);

	return true;
}
?>
