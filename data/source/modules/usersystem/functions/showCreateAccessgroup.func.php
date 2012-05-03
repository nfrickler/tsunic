<!-- | FUNCTION show form to create accessgroup -->
<?php
function $$$showCreateAccessgroup () {
	global $TSunic;

	// get empty accessgroup
	$Accessgroup = $TSunic->get('$$$Accessgroup', 0);

	// get all accessgroups
	$accessgroups = array();
	foreach ($TSunic->Usr->getAccess()->allGroups() as $index => $values) {
		if ($index == 1 or $Accessgroup->isInChildren($index)) continue;
		$accessgroups[$index] = $values;
	}

	// activate template
	$data = array(
		'Accessgroup' => $Accessgroup,
		'accessgroups' => $accessgroups,
	);
	$TSunic->Tmpl->activate('$$$showCreateAccessgroup', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEACCESSGROUP_TITLE}'));

	return true;
}
?>
