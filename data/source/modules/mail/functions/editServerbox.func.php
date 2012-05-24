<!-- | function to edit serverbox -->
<?php
function $$$editServerbox () {
	global $TSunic;

	// get input
	$id = $TSunic->Temp->getPost('id');
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
		if (empty($newMailbox) OR !$Mailbox->isValidName($newMailbox)) {
			$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
			$TSunic->redirect('back');
		}

		// create new mailbox
		if (!$Mailbox->createBox($newMailbox)) {
			$TSunic->Log->alert('error', '{EDITSERVERBOX__ERROROCCURRED}');
			$TSunic->redirect('back');
		}

	} elseif (is_numeric($selectMailbox)) {
		// mailbox selected
		$Mailbox = $TSunic->get('$$$Box', $selectMailbox);

		// check, if valid mailbox
		if (!$Mailbox->isValid()) {
			$TSunic->Log->alert('error', '{EDITSERVERBOX__ERROROCCURRED}');
			$TSunic->redirect('back');
		}

	} else {
		// invalid mailbox
		$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id);

	// validate input
	if (!$Serverbox->isValidName($name)) {
		$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// edit serverbox
	if (!$Serverbox->editServerbox($name, $Mailbox->getInfo('id'), 0)) {
		$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{EDITSERVERBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailaccount', array('$$$id' => $Serverbox->getInfo('fk_mail__account')));

	return true;
}
?>
