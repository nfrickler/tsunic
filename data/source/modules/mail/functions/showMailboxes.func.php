<!-- | function to show mailboxes -->
<?php
function $$$showMailboxes () {
	global $TSunic;

	// get SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('mailboxes' => $SuperMail->getMailboxes());
	$TSunic->Tmpl->activate('$$$showMailboxes', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAILBOXES__TITLE}'));

	return true;
}
?>
