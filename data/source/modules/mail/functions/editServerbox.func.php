<!-- | function to edit serverbox -->
<?php
function $$$editServerbox () {
	global $TSunic;

	// get input
	$id_mail__serverbox = $TSunic->Temp->getPost('id_mail__serverbox');
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
			// invalid input
			$TSunic->Log->add('error', '{EDITSERVERBOX__INVALIDINPUT}', 3);
			$TSunic->redirect('back');
		}

		// create new mailbox
		if (!$Mailbox->createBox($newMailbox)) {
			// error occurred
			$TSunic->Log->add('error', '{EDITSERVERBOX__ERROROCCURRED}', 3);
			$TSunic->redirect('back');
		}

	} elseif (is_numeric($selectMailbox)) {
		// mailbox selected
		$Mailbox = $TSunic->get('$$$Box', $selectMailbox);

		// check, if exist
		if (!$Mailbox->isValid()) {
			// invalid mailbox
			$TSunic->Log->add('error', '{EDITSERVERBOX__ERROROCCURRED}', 3);
			$TSunic->redirect('back');
		}

	} else {
		// invalid mailbox
		$TSunic->Log->add('error', '{EDITSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id_mail__serverbox);

	// validate input
	if (!$Serverbox->isValidName($name)) {
		// invalid input
		$TSunic->Log->add('error', '{EDITSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// edit serverbox
	$return = $Serverbox->editServerbox($name, $Mailbox->getInfo('id_mail__box'), 0);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{EDITSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{EDITSERVERBOX__SUCCESS}', 3);
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $Serverbox->getInfo('fk_mail__account')));

	return true;
}
?>
