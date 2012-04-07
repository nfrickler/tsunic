<!-- | function to ask, if serverbox shall be deleted -->
<?php
function $$$showDeleteServerbox () {
	global $TSunic;

	// get id_mail_serverbox
	$id_mail__serverbox = $TSunic->Temp->getParameter('id_mail__serverbox');

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id_mail__serverbox);

	// serverbox exists?
	if (!$Serverbox->isValid()) {
		$TSunic->redirect('back');
	}

	// activate template
	$data = array('Serverbox' => $Serverbox);
	$TSunic->Tmpl->activate('$$$showDeleteServerbox', '$system$content', $data);

	return true;
}
?>
