<!-- | function to show form to edit mail account -->
<?php
function $$$showEditAccount () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// activate template
	$data = array('Mailaccount' => $Mailaccount);
	$TSunic->Tmpl->activate('$$$showEditAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITACCOUNT__TITLE}'));

	return true;
}
?>
