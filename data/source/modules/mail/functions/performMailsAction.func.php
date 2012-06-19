<!-- | FUNCTION perform chosen actions from form -->
<?php
function $$$performMailsAction () {
    global $TSunic;

    // get input
    $selectedMails = $TSunic->Temp->getParameter('$$$showMailbox__selectedMails');
    $fk_mailbox = $TSunic->Temp->getPost('$$$showMailbox__moveto');

    // is any mail selected?
    if (empty($selectedMails)) {
	$TSunic->Log->alert('info', '{PERFORMMAILSACTION__SUCCESS}');
	$TSunic->redirect('back');
    }

    // choose action
    if ($TSunic->Temp->getPost('$$$showMailbox__submit_delete')) {
	// delete mails

	// get mail-objects and delete mails
	foreach ($selectedMails as $index => $value) {
	    $Mail = $TSunic->get('$$$Mail', $value);
	    $Mail->delete();
	}

    } elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_spam')) {
	// set as spam

	// TODO

    } elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_move')
		or $TSunic->Temp->getPost('$$$showMailbox__submittype')) {
	// move mails

	// get mail-objects and move mails
	foreach ($selectedMails as $index => $value) {
	    $Mail = $TSunic->get('$$$Mail', $value);
	    $Mail->move($fk_mailbox);
	}
    }

    // success
    $TSunic->Log->alert('info', '{PERFORMMAILSACTION__SUCCESS}');
    $TSunic->redirect('back');

    return true;
}
?>
