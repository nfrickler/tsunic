<!-- | function to ask, if mail shall be deleted -->
<?php
function $$$showDeleteMail () {
	global $TSunic;

	// get id_mail_mail
	$id_mail__mail = $TSunic->Temp->getParameter('id_mail__mail');

	// get mail-object
	$Mail = $TSunic->get('$$$Mail', $id_mail__mail);

	// activate template
	$data = array('mail' => $Mail);
	$TSunic->Tmpl->activate('$$$showDeleteMail', '$system$content', $data);

	return true;
}
?>
