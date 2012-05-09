<!-- | FUNCTION show page to confirm deletion of directory -->
<?php
function $$$showDeleteFsDirectory () {
	global $TSunic;

	// get Directory
	$id = $TSunic->Temp->getParameter('$$$id');
	$Directory = $TSunic->get('$$$FsDirectory', $id);

	// activate template
	$data = array('Directory' => $Directory);
	$TSunic->Tmpl->activate('$$$showDeleteFsDirectory', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEFSDIRECTORY__TITLE}'));

	return true;
}
?>
