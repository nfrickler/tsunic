<!-- | FUNCTION add new mailbox -->
<?php
function $$$addMailbox () {
    global $TSunic;

    // get input
    $name = $TSunic->Input->post('$$$formMailbox__name');
    $description = $TSunic->Input->post('$$$formMailbox__description');

    // get Mailbox object
    $Mailbox = $TSunic->get('$$$Mailbox');

    // create new mailbox
    if (!$Mailbox->create($name, $description)) {
	$TSunic->Log->alert('error', '{ADDMAILBOX__INVALIDINPUT}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{ADDMAILBOX__SUCCESS}');
    $TSunic->redirect('$$$showMailboxes');

    return true;
}
?>
