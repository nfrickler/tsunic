<!-- | function to show form to add new serverbox -->
<?php
function $$$showAddServerbox () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// check mailserver
	if (!$Mailaccount->isValid()) {
		// invalid mailaccount
		$TSunic->Log->add('error', '{SHOWADDSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create empty serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', array(0, $Mailaccount));

	// create SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('Serverbox' => $Serverbox,
				  'mailboxes' => $SuperMail->getMailboxes());
	$TSunic->Tmpl->activate('$$$showAddServerbox', '$system$content', $data);

	return true;
}
?>
