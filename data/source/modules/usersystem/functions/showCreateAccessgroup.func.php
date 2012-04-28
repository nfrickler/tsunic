<!-- | FUNCTION show form to create accessgroup -->
<?php
function $$$showCreateAccessgroup () {
	global $TSunic;

	// get empty accessgroup
	$Accessgroup = $TSunic->get('$$$Accessgroup', 0);

	// activate template
	$data = array(
		'Accessgroup' => $Accessgroup,
		'accessgroups' => $TSunic->Usr->getAccess()->allGroups();
	);
	$TSunic->Tmpl->activate('$$$showCreateAccessgroup', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEACCESSGROUP_TITLE}'));

	return true;
}
?>
