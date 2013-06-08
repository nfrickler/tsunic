<!-- | FUNCTION create new Serverbox -->
<?php
function $$$addServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $fk_mailaccount = $TSunic->Input->post('$$$formServerbox__fk_mailaccount');
    $name = $TSunic->Input->post('$$$formServerbox__name');
    $fk_mailbox = $TSunic->Input->post('$$$formServerbox__fk_mailbox');
    $newMailbox = $TSunic->Input->post('$$$formServerbox__newMailbox');

    // get mailbox-object
    if (empty($fk_mailbox)) {
	// inbox selected
	$Mailbox = $TSunic->get('$$$Inbox');

    } elseif ($fk_mailbox == 'new') {
	// create new mailbox

	// create mailbox-object
	$Mailbox = $TSunic->get('$$$Mailbox');

	// validate input
	if (!$Mailbox->isValidName($newMailbox)) {
	    $TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
	    $TSunic->redirect('back');
	}

	// create new mailbox
	if (!$Mailbox->create($newMailbox)) {
	    $TSunic->Log->alert('error', '{ADDSERVERBOX__ERROR}');
	    $TSunic->redirect('back');
	}

    } elseif (is_numeric($fk_mailbox)) {
	// mailbox selected
	$Mailbox = $TSunic->get('$$$Mailbox', $fk_mailbox);

	// check, if exist
	if (!$Mailbox->isValid()) {
	    $TSunic->Log->alert('error', '{ADDSERVERBOX__ERROR}');
	    $TSunic->redirect('back');
	}

    } else {
	// invalid mailbox
	$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // get Serverbox object
    $Serverbox = $TSunic->get('$$$Serverbox');

    // validate input
    if (!$Serverbox->isValidName($name)
	OR !$Serverbox->isValidFkAccount($fk_mailaccount)
    ) {
	$TSunic->Log->alert('error', '{ADDSERVERBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // add serverbox
    if (!$Serverbox->create($fk_mailaccount, $name, $Mailbox->getInfo('id'), 0)) {
	$TSunic->Log->alert('error', '{ADDSERVERBOX__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{ADDSERVERBOX__SUCCESS}');
    $TSunic->redirect(
	'$$$showMailaccount',
	array('$$$id' => $Serverbox->getInfo('fk_mailaccount'))
    );

    return true;
}
?>
