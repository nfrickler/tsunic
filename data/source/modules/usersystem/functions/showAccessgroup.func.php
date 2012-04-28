<!-- | FUNCTION show one accessgroup -->
<?php
function $$$showAccessgroup () {
	global $TSunic;

	// get accessgroup
	$id = $TSunic->Temp->getParameter('$$$id');
	$Accessgroup = $TSunic->get('$$$Accessgroup', $id);

	// activate template
	$data = array(
		'Accessgroup' => $Accessgroup,
		'accessgroups' => $TSunic->Usr->getAccess()->allGroups()
	);
	$TSunic->Tmpl->activate('$$$showAccessgroup', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWACCESSGROUP__TITLE}'));

	return true;
}
?>
