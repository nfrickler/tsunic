<!-- | function to ask, if SMTP shall be deleted -->
<?php
function $$$showDeleteSmtp () {
	global $TSunic;

	// get id_mail__smtp
	$id_mail__smtp = $TSunic->Temp->getParameter('id_mail__smtp');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp', $id_mail__smtp);

	// activate template
	$data = array('Smtp' => $Smtp);
	$TSunic->Tmpl->activate('$$$showDeleteSmtp', '$system$content', $data);

	return true;
}
?>
