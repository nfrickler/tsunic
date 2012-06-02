<!-- | function to show form to edit mail -->
<?php
function $$$showEditMail () {
	global $TSunic;

	// any smtp servers available?
	$SuperMail = $TSunic->get('$$$SuperMail');
	$smtps = $SuperMail->getSmtps(true);
	if (empty($smtps)) {
		$TSunic->Log->alert('error', '{SHOWEDITMAIL__ADDSMTPFIRST}');
		$TSunic->redirect('$$$showAddSmtp');
	}

	// get Mail object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mail = $TSunic->get('$$$Mail', $id);
	if (!$Mail->isValid()) {
		$TSunic->Log->alert('error', '{SHOWEDITMAIL__NOTEXISTING}');
		$TSunic->redirect('back');
	}

	// activate template
	$data = array(
		'Mail' => $Mail,
		'smtps' => $smtps
	);
	$TSunic->Tmpl->activate('$$$showEditMail', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITMAIL__TITLE}'));

	return true;
}
?>
