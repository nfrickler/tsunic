<!-- | FUNCTION refresh serverboxes -->
<?php
function $$$refreshServerboxes () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get id
    $id = $TSunic->Input->uint('$$$id');

    if (!empty($id) AND is_numeric($id)) {

	// get Mailaccount object
	$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

	// update serverboxes
	if ($Mailaccount->updateServerboxes()) {
	    $TSunic->Log->alert('info', '{REFRESHSERVERBOXES__SUCCESS}');
	} else {
	    $TSunic->Log->alert('error', '{REFRESHSERVERBOXES__ERROR}');
	}
    }

    // redirect back
    $TSunic->redirect('back');
    return true;
}
?>
