<!-- | function to ask, if mailbox shall be deleted -->
<?php
function $$$showDeleteMailbox () {
	global $TSunic;

	// get id_mail_box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

	// activate template
	$data = array('mailbox' => $Mailbox);
	$TSunic->Tmpl->activate('$$$showDeleteMailbox', '$system$content', $data);

	return true;
}
?>
