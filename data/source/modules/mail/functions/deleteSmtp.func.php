<!-- | function to delete SMTP -->
<?php
function $$$deleteSmtp () {
    global $TSunic;

    // get smtp object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Smtp = $TSunic->get('$$$Smtp', $id);

    // delete smtp server
    if (!$Smtp->deleteSmtp()) {
	$TSunic->Log->alert('error', '{DELETESMTP__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{DELETESMTP__SUCCESS}');
    $TSunic->redirect('back');

    return true;
}
?>
