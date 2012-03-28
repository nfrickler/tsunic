<!-- | -->
<?php

function $$$showAddMailbox () {
	global $TSunic;

	// create new mailbox-object
	$Mailbox = $TSunic->get('$$$Box');

	// activate template
	$data = array('mailbox' => $Mailbox);
	$TSunic->Tmpl->activate('$$$showAddMailbox', '$system$content', $data);

	return true;
}
?>
