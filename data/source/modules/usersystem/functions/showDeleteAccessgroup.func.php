<!-- | FUNCTION show page to confirm accessgroup deletion -->
<?php
function $$$showDeleteAccessgroup () {
	global $TSunic;

	// get Accessgroup
	$id = $TSunic->Temp->getParameter('$$$id');
	$Accessgroup = $TSunic->get('$$$Accessgroup', $id);

	// activate template
	$data = array('Accessgroup' => $Accessgroup);
	$TSunic->Tmpl->activate('$$$showDeleteAccessgroup', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCESSGROUP__TITLE}'));

	return true;
}
?>
