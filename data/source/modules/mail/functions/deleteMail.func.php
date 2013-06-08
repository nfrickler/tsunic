<!-- | FUNCTION delete mail -->
<?php
function $$$deleteMail () {
    global $TSunic;

    // get Mail object and fk_mailbox
    $id = $TSunic->Input->uint('$$$id');
    $Mail = $TSunic->get('$$$Mail', $id);
    $fk_mailbox = $Mail->getInfo('fk_mailbox');

    // delete Mail
    if (!$Mail->delete()) {
	$TSunic->Log->alert('error', '{DELETEMAIL__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{DELETEMAIL__SUCCESS}');
    $TSunic->redirect('$$$showMailbox', array('$$$id' => $fk_mailbox));

    return true;
}
?>
