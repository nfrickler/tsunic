<!-- | function to delete SMTP -->
<?php
function $$$deleteSmtp () {
	global $TSunic;

	// get input
	$id_mail_smtp = $TSunic->Temp->getParameter('id_mail__smtp');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp', $id_mail_smtp);

	// delete smtp-server
	$return = $Smtp->deleteSmtp();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETESMTP__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETESMTP__SUCCESS}', 3);
	$TSunic->redirect('back');

	return true;
}
?>
