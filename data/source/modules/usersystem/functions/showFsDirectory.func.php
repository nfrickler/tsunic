<!-- | FUNCTION show content of filesystem directory -->
<?php
function $$$showFsDirectory () {
	global $TSunic;

	// get directory id
	$id = $TSunic->Temp->getParameter('$$$id');
	$Dir = $TSunic->get('$$$FsDirectory', $id);

	// activate template
	$data = array('Directory' => $Dir);
	$TSunic->Tmpl->activate('$$$showFsDirectory', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWFSDIRECTORY__TITLE}'));

	return true;
}
?>
