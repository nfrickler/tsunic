<!-- | function to ask if mail account shall be deleted -->
<?php
function $$$showDeleteAccount () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get mailaccount-object
	$Account = $TSunic->get('$$$Account', $id_mail__account);

	// activate template
	$data = array('Account' => $Account);
	$TSunic->Tmpl->activate('$$$showDeleteAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCOUNT__TITLE}'));

	return true;
}
?>
