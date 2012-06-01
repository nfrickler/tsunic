<!-- | function to ask, if serverbox shall be deleted -->
<?php
function $$$showDeleteServerbox () {
	global $TSunic;

	// get Serverbox object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Serverbox = $TSunic->get('$$$Serverbox', $id);

	// serverbox exists?
	if (!$Serverbox->isValid()) {
		$TSunic->redirect('back');
	}

	// activate template
	$data = array('Serverbox' => $Serverbox);
	$TSunic->Tmpl->activate('$$$showDeleteServerbox', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETESERVERBOX__TITLE}'));

	return true;
}
?>
