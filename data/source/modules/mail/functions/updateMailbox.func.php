<!-- | function to update current mailbox -->
<?php
function $$$updateMailbox () {
	global $TSunic;

	// get id_mail_box
	$id = $TSunic->Temp->getParameter('$$$id');
	$force = ($TSunic->Temp->getParameter('force')) ? true : false;

	// get mailbox-object
	$Mailbox = (empty($id))
		? $TSunic->get('$$$Inbox')
		: $TSunic->get('$$$Box', $id);

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
