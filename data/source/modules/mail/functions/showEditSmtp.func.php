<!-- | function to show form to edit SMTP -->
<?php

function $$$showEditSmtp () {
	global $TSunic;

	// get Smtp object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Smtp = $TSunic->get('$$$Smtp', $id);

	// get SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array(
		'Smtp' => $Smtp,
		'mailaccounts' => $SuperMail->getMailaccounts()
	);
	$TSunic->Tmpl->activate('$$$showEditSmtp', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITSMTP__TITLE}'));

	return true;
}
?>
