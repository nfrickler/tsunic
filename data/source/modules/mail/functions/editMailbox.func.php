<!-- | function to edit mailbox -->
<?php
function $$$editMailbox () {
    global $TSunic;

    // get input
    $id = $TSunic->Input->uint('$$$formMailbox__id');
    $name = $TSunic->Input->post('$$$formMailbox__name');
    $description = $TSunic->Input->post('$$$formMailbox__description');

    // get mailbox-object
    $Mailbox = $TSunic->get('$$$Mailbox', $id);

    // edit mailbox
    if (!$Mailbox->edit($name, $description)) {
	$TSunic->Log->alert('error', '{EDITMAILBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{EDITMAILBOX__SUCCESS}');
    $TSunic->redirect('$$$showMailboxes');

    return true;
}
?>
