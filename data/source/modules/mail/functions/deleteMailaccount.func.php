<!-- | FUNCTION delete mail account -->
<?php
function $$$deleteMailaccount () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get mailaccount object
    $id = $TSunic->Input->uint('$$$id');
    $Mailaccount = $TSunic->get('$$$Mailaccount', $id);

    // delete mailaccount
    if (!$Mailaccount->delete()) {
	$TSunic->Log->alert('error', '{DELETEMAILACCOUNT__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{DELETEMAILACCOUNT__SUCCESS}');
    $TSunic->redirect('$$$showMailservers');

    return true;
}
?>
