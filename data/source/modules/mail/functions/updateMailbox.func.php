<!-- | function to update current mailbox -->
<?php
function $$$updateMailbox () {
	global $TSunic;

	// get id_mail_box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');
	$force = ($TSunic->Temp->getParameter('force')) ? true : false;

	// get mailbox-object
	$Mailbox = (empty($id_mail__box))
		? $TSunic->get('$$$Inbox')
		: $TSunic->get('$$$Box', $id_mail__box);

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
		$TSunic->Log->add('info', '{UPDATEMAILBOX__SUCCESS}');
		$TSunic->redirect('$$$showMailbox', array('id_mail__box' => $Mailbox->getInfo('id_mail__box')));
		exit;
	}
}
?>
