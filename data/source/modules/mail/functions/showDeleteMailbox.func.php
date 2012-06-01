<!-- | function to ask, if mailbox shall be deleted -->
<?php
function $$$showDeleteMailbox () {
	global $TSunic;

	// get Mailbox object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailbox = $TSunic->get('$$$Mailbox', $id);

	// activate template
	$data = array('Mailbox' => $Mailbox);
	$TSunic->Tmpl->activate('$$$showDeleteMailbox', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEMAILBOX__TITLE}'));

	return true;
}
?>
