<!-- | function to delete serverbox -->
<?php
function $$$deleteServerbox () {
    global $TSunic;

    // get Serverbox object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Serverbox = $TSunic->get('$$$Serverbox', $id);

    // get id of mail account
    $fk_mail__account = $Serverbox->getMailaccount(true);

    // delete serverbox
    if (!$Serverbox->deleteServerbox()) {
	$TSunic->Log->alert('error', '{DELETESERVERBOX__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{DELETESERVERBOX__SUCCESS}');
    $TSunic->redirect('$$$showMailaccount', array('$$$id' => $fk_mail__account));

    return true;
}
?>
