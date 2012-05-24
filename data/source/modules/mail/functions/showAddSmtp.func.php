<!-- | function to show form to add new SMTP -->
<?php
function $$$showAddSmtp () {
	global $TSunic;

	// get input
	$fk_mail__account = $TSunic->Temp->getParameter('fk_mail__account');

	// get empty Smtp object
	$Smtp = $TSunic->get('$$$Smtp');

	// set mailaccount?
	if (!empty($fk_mail__account)) {
		$Mailaccount = $TSunic->get('$$$Mailaccount', $fk_mail__account);
		$Smtp->setMailaccount($Mailaccount);
	}

	// get SuperMail object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array(
		'Smtp' => $Smtp,
		'mailaccounts' => $SuperMail->getMailaccounts()
	);
	$TSunic->Tmpl->activate('$$$showAddSmtp', '$system$content', $data);

	return true;
}
?>
