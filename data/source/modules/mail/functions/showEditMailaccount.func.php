<!-- | function to show form to edit mail account -->
<?php
function $$$showEditMailaccount () {
	global $TSunic;

	// get Mailaccount object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

	// activate template
	$data = array(
		'Mailaccount' => $Mailaccount,
		'name' => $Mailaccount->getInfo('name')
	);
	$TSunic->Tmpl->activate('$$$showEditMailaccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITACCOUNT__TITLE}'));

	return true;
}
?>
