<!-- | FUNCTION show page to confirm deletion of file -->
<?php
function $$$showDeleteFsFile () {
	global $TSunic;

	// get File
	$id = $TSunic->Temp->getParameter('$$$id');
	$File = $TSunic->get('$$$FsFile', $id);

	// activate template
	$data = array('File' => $File);
	$TSunic->Tmpl->activate('$$$showDeleteFsFile', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEFSFILE__TITLE}'));

	return true;
}
?>
