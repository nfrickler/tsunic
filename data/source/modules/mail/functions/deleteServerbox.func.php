<!-- | FUNCTION delete serverbox -->
<?php
function $$$deleteServerbox () {
    global $TSunic;

    // get Serverbox object
    $id = $TSunic->Temp->getParameter('$$$id');
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
