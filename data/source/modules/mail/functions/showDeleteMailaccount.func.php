<!-- | function to ask if mail account shall be deleted -->
<?php
function $$$showDeleteMailaccount () {
	global $TSunic;

	// get Mailaccount object
	$id = $TSunic->Temp->getParameter('$$$id');
	$Mailaccount = $TSunic->get('$$$Mailaccount', $id);

	// activate template
	$data = array('Mailaccount' => $Mailaccount);
	$TSunic->Tmpl->activate('$$$showDeleteMailaccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCOUNT__TITLE}'));

	return true;
}
?>
