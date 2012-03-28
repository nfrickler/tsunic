<!-- | -->
<?php

function $$$showMailContent () {
	global $TSunic;

	// get id_mail_mail
	$id_mail__mail = $TSunic->Temp->getParameter('id_mail__mail');

	// get mail-object
	$Mail = $TSunic->get('$$$Mail', $id_mail__mail);

	// activate template
	$data = array('mail' => $Mail);
	$TSunic->Tmpl->activate('$$$showMailContent', false, $data);

	// set charset
	$charset = $Mail->getInfo('charset');
	if (!empty($charset)) {
		header('Content-Type: text/html; charset='.$charset);

	}

	return true;
}
?>
