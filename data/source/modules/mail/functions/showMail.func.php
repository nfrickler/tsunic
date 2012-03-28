<!-- | -->
<?php

function $$$showMail () {
	global $TSunic;

	// get id_mail_mail
	$id_mail__mail = $TSunic->Temp->getParameter('id_mail__mail');

	// get e-mail-server-object
	$Mail = $TSunic->get('$$$Mail', array($id_mail__mail));

	// activate template
	$data = array('mail' => $Mail);
	$TSunic->Tmpl->activate('$$$showMail', '$system$content', $data);

	return true;
}
?>
