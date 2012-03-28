<!-- | -->
<?php

function $$$showAccount () {
	global $TSunic;

	// activate template
	$data = array('User' => $TSunic->CurrentUser);
	$TSunic->Tmpl->activate('$$$showAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCOUNT__TITLE}'));

	return true;
}
?>
