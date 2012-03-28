<!-- | function to show index-page (default startup-page) -->
<?php

function $$$showSysteminfo () {
	global $TSunic;

	// get infos about modules
	$sql_0 = "SELECT *
		FROM ".$TSunic->Config->getConfig('preffix')."modules
		WHERE is_activated = 1
			AND is_parsed = 1
		ORDER BY name ASC;";
	$result_0 = $TSunic->Db->doSelect($sql_0);

	// activate template
	$data = array('modules' => $result_0);
	$TSunic->Tmpl->activate('$$$showSysteminfo', '$$$content', $data);
	$TSunic->Tmpl->activate('$$$html', false, array('title' => '{SYSTEMINFO__TITLE}'));

	return true;
}
?>
