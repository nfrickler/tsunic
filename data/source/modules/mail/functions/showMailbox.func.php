<!-- | function to show mailbox -->
<?php
function $$$showMailbox () {
	global $TSunic;

	// get MailBox object
	$id = $TSunic->Temp->getParameter('$$$id');
	if (!is_numeric($id)) $id = 0;
	$Mailbox = ($id == 0) ? $TSunic->get('$$$Inbox') : $TSunic->get('$$$Mailbox', $id);

	// get mailboxes
	$Supermail = $TSunic->get('$$$SuperMail');
	$mailboxes = $Supermail->getMailboxes();
	foreach ($mailboxes as $index => $Value) {
		if ($Value->getInfo('id') == $id) {
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
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAILBOX__TITLE}'));

	return true;
}
?>
