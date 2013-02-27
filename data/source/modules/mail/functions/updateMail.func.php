<!-- | FUNCTION create/edit Mail and send if requested -->
<?php
function $$$updateMail () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getParameter('$$$formMail__id');
    $sender = $TSunic->Temp->getParameter('$$$formMail__sender');
    $content = $TSunic->Temp->getParameter('$$$formMail__content');
    $send = ($TSunic->Temp->getParameter('$$$formMail__send'))
	? true : false;

    // create new Mail object
    // get Mail object
    $Mail = $TSunic->get('$$$Mail', $id);
    if (empty($id) and !$Mail->create()) {
	// an error occurred!
	$TSunic->Log->alert('error', '{UPDATEMAIL__ERROR}');
	$TSunic->Log->log('3',
	    'mail::createMail: ERROR: Failed to create new mail');
	$TSunic->redirect('back');
    }
    if (!$Mail->isValid()) {
	$TSunic->Log->alert('error', '{UPDATEMAIL__NOTEXISTING}');
	$TSunic->redirect('back');
    }

    // validate and save sender
    if (!$Mail->isValidSender($sender)) {
	$TSunic->Log->alert('error', '{UPDATEMAIL__INVALIDSENDER}');
	$TSunic->redirect('back');
    }
    if (!$Mail->saveByTag('MAIL__SENDER', $sender)) {
	$TSunic->Log->alert('error', '{UPDATEMAIL__ERRORADDSENDER}');
	$TSunic->redirect('back');
    }
    if (!$Mail->saveByTag('MAIL__PLAINCONTENT', $content)) {
	$TSunic->Log->alert('error', '{UPDATEMAIL__ERRORADDCONTENT}');
	$TSunic->redirect('back');
    }

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{UPDATEMAIL__INVALIDVALUE} ('.
	    $fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Mail->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{UPDATEMAIL__ERROR}');
	    $TSunic->Log->log('3', 'mail::createMail: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // send Mail if requested
    if ($send) {
	if (!$Mail->send()) {
	    $TSunic->Log->alert('error', '{UPDATEMAIL__SENDERROR}');
	    $TSunic->redirect('back');
	} else {
	    $TSunic->Log->alert('info', '{UPDATEMAIL__SENDSUCCESS}');
	}
    } else {
	$TSunic->Log->alert('info', '{UPDATEMAIL__SAVESUCCESS}');
    }

    // success
    $TSunic->redirect('$$$showMailboxes');
    return true;
}
?>
