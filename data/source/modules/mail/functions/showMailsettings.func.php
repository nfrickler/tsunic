<!-- | -->
<?php

function $$$showMailsettings () {
	global $TSunic;

	// get superMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('mailboxes' => $SuperMail->getMailboxes());
	$TSunic->Tmpl->activate('$$$showMailsettings', '$system$content', $data);

	return true;
}
?>
