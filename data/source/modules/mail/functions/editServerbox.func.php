<!-- | FUNCTION edit serverbox -->
<?php
function $$$editServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $id = $TSunic->Temp->getPost('$$$formServerbox__id');
    $name = $TSunic->Temp->getPost('$$$formServerbox__name');
    $selectMailbox = $TSunic->Temp->getPost('$$$formServerbox__fk_mailbox');
    $newMailbox = $TSunic->Temp->getPost('$$$formServerbox__newMailbox');

    // get mailbox-object
    if ($selectMailbox === "0" or $selectMailbox === 0) {
	// inbox selected
	$Mailbox = $TSunic->get('$$$Inbox');

    } elseif ($selectMailbox == 'new') {
	// create new mailbox

	// create mailbox-object
	$Mailbox = $TSunic->get('$$$Mailbox');

	// validate input
	if (empty($newMailbox) OR !$Mailbox->isValidName($newMailbox)) {
	    $TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
	    $TSunic->redirect('back');
	}

	// create new mailbox
	if (!$Mailbox->create($newMailbox)) {
	    $TSunic->Log->alert('error', '{EDITSERVERBOX__ERROROCCURRED}');
	    $TSunic->redirect('back');
	}

    } elseif (is_numeric($selectMailbox)) {
	// mailbox selected
	$Mailbox = $TSunic->get('$$$Mailbox', $selectMailbox);

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
    if (!$Serverbox->edit($name, $Mailbox->getInfo('id'), 0)) {
	$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{EDITSERVERBOX__SUCCESS}');
    $TSunic->redirect(
	'$$$showMailaccount',
	array('$$$id' => $Serverbox->getInfo('fk_mailaccount'))
    );

    return true;
}
?>
