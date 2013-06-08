<!-- | FUNCTION delete serverbox -->
<?php
function $$$deleteServerbox () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('useImapSmtp')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Serverbox object
    $id = $TSunic->Input->uint('$$$id');
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // get id of mailaccount
    $fk_mailaccount = $Serverbox->getMailaccount(true);

    // delete serverbox
    if (!$Serverbox->delete()) {
	$TSunic->Log->alert('error', '{DELETESERVERBOX__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{DELETESERVERBOX__SUCCESS}');
    $TSunic->redirect('$$$showMailaccount', array('$$$id' => $fk_mailaccount));

    return true;
}
?>
