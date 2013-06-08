<!-- | FUNCTION check for new mails for this mailbox -->
<?php
function $$$updateMailbox () {
    global $TSunic;

    // get parameters
    $force = ($TSunic->Input->param('force')) ? true : false;

    // get Mailbox object
    $id = $TSunic->Input->uint('$$$id');
    $Mailbox = (empty($id))
	? $TSunic->get('$$$Inbox')
	: $TSunic->get('$$$Mailbox', $id);

    // check for new mails
    $all_new_mails = $Mailbox->checkMails($force);

    // is ajax-call?
    if ($TSunic->isAjax()) {
	// activate template
	$data = array(
	    'success' => 'true',
	    'new_mails' => $all_new_mails
	);
	$TSunic->Tmpl->activate('$$$updateMailbox', 'xmlResponse', $data);

	return true;
    } else {
	$TSunic->Log->alert('info', '{UPDATEMAILBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailbox', array('$$$id' => $Mailbox->getInfo('id')));
	exit;
    }
}
?>
