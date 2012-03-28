<!-- | -->
<?php

function $$$showSendMail () {
	global $TSunic;

	// create new mailbox-object
	$Mail = $TSunic->get('$$$Mail');

	// create new mailbox-object
	$SuperMail = $TSunic->get('$$$SuperMail');
	$smtps = $SuperMail->getSmtps(true);

	// is any smtp?
	if (empty($smtps)) {
		// no smtp-server available!
		$TSunic->Log->add('error', '{SHOWSENDMAIL__ADDSMTPFIRST}');
		$TSunic->redirect('$$$showAddSmtp');
	}

	// activate template
	$data = array('Mail' => $Mail,
				  'smtps' => $smtps);
	$TSunic->Tmpl->activate('$$$showSendMail', '$system$content', $data);

	return true;
}
?>
