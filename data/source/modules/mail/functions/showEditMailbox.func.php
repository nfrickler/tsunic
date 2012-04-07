<!-- | function to show form to edit mailbox -->
<?php
function $$$showEditMailbox () {
	global $TSunic;

	// get id_mail_box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');

	// get mailbox-object
	$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

	// activate template
	$data = array('mailbox' => $Mailbox);
	$TSunic->Tmpl->activate('$$$showEditMailbox', '$system$content', $data);

	return true;
}
?>
