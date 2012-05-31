<!-- | function to show form to create new mail -->
<?php
function $$$showCreateMail () {
	global $TSunic;

	// any smtp servers available?
	$SuperMail = $TSunic->get('$$$SuperMail');
	$smtps = $SuperMail->getSmtps(true);
	if (empty($smtps)) {
		$TSunic->Log->alert('error', '{SHOWCREATEMAIL__ADDSMTPFIRST}');
		$TSunic->redirect('$$$showAddSmtp');
	}

	// get empty Mail object
	$Mail = $TSunic->get('$$$Mail');

	// activate template
	$data = array(
		'Mail' => $Mail,
		'smtps' => $smtps
	);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEMAIL__TITLE}'));
	$TSunic->Tmpl->activate('$$$showCreateMail', '$system$content', $data);

	return true;
}
?>
