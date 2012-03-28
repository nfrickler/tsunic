<!-- | -->
<?php

function $$$showAddAccount () {
	global $TSunic;

	// get empty mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account');

	// activate template
	$data = array('Mailaccount' => $Mailaccount);
	$TSunic->Tmpl->activate('$$$showAddAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWADDACCOUNT__TITLE}'));

	return true;
}
?>
