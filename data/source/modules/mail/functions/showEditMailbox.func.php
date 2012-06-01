<!-- | function to show form to edit mailbox -->
<?php
function $$$showEditMailbox () {
	global $TSunic;

	// get Mailbox object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailbox = $TSunic->get('$$$Mailbox', $id);

	// activate template
	$data = array(
		'Mailbox' => $Mailbox,
		'name' => $Mailbox->getInfo('name'),
	);
	$TSunic->Tmpl->activate('$$$showEditMailbox', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITMAILBOX__TITLE}'));

	return true;
}
?>
