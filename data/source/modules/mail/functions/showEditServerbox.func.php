<!-- | function to show form to edit serverbox -->
<?php
function $$$showEditServerbox () {
	global $TSunic;

	// get id_mail__serverbox
	$id_mail__serverbox = $TSunic->Temp->getParameter('id_mail__serverbox');

	// create empty serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id_mail__serverbox);

	// create SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('Serverbox' => $Serverbox,
				  'mailboxes' => $mailboxes = $SuperMail->getMailboxes());
	$TSunic->Tmpl->activate('$$$showEditServerbox', '$system$content', $data);

	return true;
}
?>
