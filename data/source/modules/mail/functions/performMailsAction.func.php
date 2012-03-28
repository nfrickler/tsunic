<!-- | -->
<?php

function $$$performMailsAction () {
	global $TSunic;

	// get input
	$selectedMails = $TSunic->Temp->getParameter('$$$showMailbox__selectedMails');
	$fk_mail__box = $TSunic->Temp->getPost('$$$showMailbox__moveto');

	// is any mail selected?
	if (empty($selectedMails)) {
		// no mails selected
		$TSunic->Log->add('info', '{PERFORMMAILSACTION__SUCCESS}');
		$TSunic->redirect('back');
	}

	// choose action
	if ($TSunic->Temp->getPost('$$$showMailbox__submit_delete')) {
		// delete mails

		// get mail-objects and delete mails
		foreach ($selectedMails as $index => $value) {
			// get object
			$Mail = $TSunic->get('$$$Mail', $value);

			// delete mail
			$Mail->deleteMail();
		}

	} elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_spam')) {
		// set as spam

		// TODO

	} elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_move')
				or $TSunic->Temp->getPost('$$$showMailbox__submittype')) {
		// move mails

		// get mail-objects and delete mails
		foreach ($selectedMails as $index => $value) {
			// get object
			$Mail = $TSunic->get('$$$Mail', $value);

			// move mail
			$Mail->move($fk_mail__box);
		}
	}

	// success
	$TSunic->Log->add('info', '{PERFORMMAILSACTION__SUCCESS}');
	$TSunic->redirect('back');

	return true;
}
?>
