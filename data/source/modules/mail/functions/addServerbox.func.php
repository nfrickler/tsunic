<!-- | function to add new serverbox -->
<?php
function $$$addServerbox () {
	global $TSunic;

	// get input
	$fk_mail__server = $TSunic->Temp->getPost('id_mail__account');
	$name = $TSunic->Temp->getPost('$$$formServerbox__name');
	$selectMailbox = $TSunic->Temp->getPost('$$$formServerbox__selectMailbox');
	$newMailbox = $TSunic->Temp->getPost('$$$formServerbox__newMailbox');

	// get mailbox-object
	if ($selectMailbox === 0) {
		// inbox selected
		$Mailbox = $TSunic->get('$$$Inbox');

	} elseif ($selectMailbox == 'new') {
		// create new mailbox

		// create mailbox-object
		$Mailbox = $TSunic->get('$$$Box');

		// validate input
		if (!$Mailbox->isValidName($newMailbox)) {
			$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
			$TSunic->redirect('back');
		}

		// create new mailbox
		if (!$Mailbox->createBox($newMailbox)) {
			$TSunic->Log->alert('error', '{ADDSERVERBOX__ERROROCCURRED}');
			$TSunic->redirect('back');
		}

	} elseif (is_numeric($selectMailbox)) {
		// mailbox selected
		$Mailbox = $TSunic->get('$$$Box', $selectMailbox);

		// check, if exist
		if (!$Mailbox->isValid()) {
			// invalid mailbox
			$TSunic->Log->alert('error', '{ADDSERVERBOX__ERROROCCURRED}');
			$TSunic->redirect('back');
		}

	} else {
		// invalid mailbox
		$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox');

	// validate input
	if (!$Serverbox->isValidName($name)
		OR !$Serverbox->isValidFkAccount($fk_mail__account)) {
		// invalid input

		$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// add serverbox
	if (!$Serverbox->createServerbox($fk_mail__account, $name, $Mailbox->getInfo('id'), 0)) {
		$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{ADDSERVERBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>
