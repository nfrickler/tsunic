<!-- | -->
<?php

function $$$_showSystemNavigation () {
	global $TSunic;

	// create new SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// get all mailboxes
	$mailboxes = $SuperMail->getMailboxes();

	// activate template
	$data = array('mailboxes' => $mailboxes);
	$TSunic->Tmpl->activate('$$$_system_navigation', '$navigation$show', $data);

	return true;
}
?>
