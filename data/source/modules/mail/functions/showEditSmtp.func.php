<!-- | -->
<?php

function $$$showEditSmtp () {
	global $TSunic;

	// get id_mail__smtp
	$id_mail__smtp = $TSunic->Temp->getParameter('id_mail__smtp');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp', $id_mail__smtp);

	// get SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('Smtp' => $Smtp,
				  'mailaccounts' => $SuperMail->getMailaccounts());
	$TSunic->Tmpl->activate('$$$showEditSmtp', '$system$content', $data);

	return true;
}
?>
