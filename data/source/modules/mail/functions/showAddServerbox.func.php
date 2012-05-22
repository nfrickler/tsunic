<!-- | function to show form to add new serverbox -->
<?php
function $$$showAddServerbox () {
	global $TSunic;

	// get mailaccount object
	$id = $TSunic->Temp->getParameter('id');
	$Mailaccount = $TSunic->get('$$$Account', $id);

	// valid mailaccount?
	if (!$Mailaccount->isValid()) {
		$TSunic->Log->alert('error', '{SHOWADDSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create empty serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', array(0, $Mailaccount));

	// create SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array(
		'Serverbox' => $Serverbox,
		'mailboxes' => $SuperMail->getMailboxes()
	);
	$TSunic->Tmpl->activate('$$$showAddServerbox', '$system$content', $data);

	return true;
}
?>
