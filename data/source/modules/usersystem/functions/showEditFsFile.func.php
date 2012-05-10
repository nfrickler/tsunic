<!-- | FUNCTION show form to edit file -->
<?php
function $$$showEditFsFile () {
	global $TSunic;

	// get id
	$id = $TSunic->Temp->getParameter('$$$id');

	// create objects
	$File = $TSunic->get('$$$FsFile', $id);
	$Dir = $TSunic->get('$$$FsDirectory');

	// activate template
	$data = array(
		'File' => $File,
		'directories' => $Dir->allDirectories(),
	);
	$TSunic->Tmpl->activate('$$$showEditFsFile', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITFSFILE__TITLE}'));

	return true;
}
?>
