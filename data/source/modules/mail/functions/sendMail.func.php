<!-- | function to send mail -->
<?php
function $$$sendMail () {
	global $TSunic;

	// get input
	$id_mail__smtp = $TSunic->Temp->getPost('$$$showSendMail__id_mail__smtp');
	$addressees = $TSunic->Temp->getPost('$$$showSendMail__addressee');
	$subject = $TSunic->Temp->getPost('$$$showSendMail__subject');
	$content = $TSunic->Temp->getPost('$$$showSendMail__content');
	$addressees = explode(';', $addressees);

	// get smtp-server-object
	if ($id_mail__smtp == 0) {
		$Smtp = $TSunic->get('$$$SenderLocal');
	} else {
		$Smtp = $TSunic->get('$$$Smtp', $id_mail__smtp);
	}

	// validate input
	if (!$Smtp->isValidSubject($subject)
			OR !$Smtp->isValidMessage($content)
		) {
		$TSunic->Log->alert('error', '{SENDMAIL__INVALIDINPUT}');
		$TSunic->redirect('back');
	}
	foreach ($addressees as $index => $value) {
		if (!$Smtp->isValidAddressee($value)) {
			// invalid addressee
			$TSunic->Log->alert('error', '{SENDMAIL__INVALIDADDRESSEE}');
			$TSunic->redirect('back');
		}
	}

	// send mail
	if (!$Smtp->sendMail($addressees, $subject, $content)) {
		$TSunic->Log->alert('error', '{SENDMAIL__ERROR} ('.$Smtp->getInfo('error_msg').')');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->alert('info', '{SENDMAIL__SUCCESS}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>
