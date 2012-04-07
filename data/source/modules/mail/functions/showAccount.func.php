<!-- | function to show mail account -->
<?php
function $$$showAccount () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get Mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// activate template
	$data = array('Mailaccount' => $Mailaccount);
	$TSunic->Tmpl->activate('$$$showAccount', '$system$content', $data);

	return true;
}
?>
