<!-- | FUNCTION edit Serverbox -->
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
    $fk_mailbox =
	$TSunic->Temp->getPost('$$$formServerbox__fk_mailbox');
    $newMailbox = $TSunic->Temp->getPost('$$$formServerbox__newMailbox');

    // get mailbox-object
    if (empty($fk_mailbox)) {
	// inbox selected
	$Mailbox = $TSunic->get('$$$Inbox');

    } elseif ($fk_mailbox == 'new') {
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

    } elseif (is_numeric($fk_mailbox)) {
	// mailbox selected
	$Mailbox = $TSunic->get('$$$Mailbox', $fk_mailbox);

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

    // get Serverbox object
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // validate input
    if (!$Serverbox->isValidName($name)) {
	$TSunic->Log->alert('error', '{EDITSERVERBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // edit serverbox
    if (!$Serverbox->edit($name, $Mailbox->getInfo('id'), false)) {
	$TSunic->Log->alert('error', '{EDITSERVERBOX__ERROR}');
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
