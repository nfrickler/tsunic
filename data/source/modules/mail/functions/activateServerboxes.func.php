<!-- | FUNCTION activate serverboxes -->
<?php
function $$$activateServerboxes () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get input
    $activated_serverboxes =
	$TSunic->Input->postByPrefix('$$$showMailaccount__serverboxes_');

    // get Mailaccount object
    $id = $TSunic->Input->getParam('$$$id');
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // get all serverboxes
    $all_serverboxes = $Mailaccount->getServerboxes();

    // check all serverboxes
    foreach ($all_serverboxes as $index => $value) {

	// is active?
	if ($value->getInfo('isActive')) {
	    // is active

	    // is not selected?
	    if (!isset($activated_serverboxes[$value->getInfo('id')])) {
		// deactivate
		$value->activate(false);
	    }

	} else {
	    // is inactive

	    // is selected?
	    if (isset($activated_serverboxes[$value->getInfo('id')])) {
		// activate
		$value->activate(true);
	    }
	}
    }

    // success
    $TSunic->Log->alert('info', '{ACTIVATESERVERBOXES__SUCCESS}');
    $TSunic->redirect('back');

    return true;
}
?>
