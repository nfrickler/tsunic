<!-- | FUNCTION show page to confirm deletion of directory -->
<?php
function $$$showDeleteFsDirectory () {
    global $TSunic;

    // get Directory
    $id = $TSunic->Temp->getParameter('$$$id');
    $Directory = $TSunic->get('$$$FsDirectory', $id);

    // is empty directory?
    if ($Directory->getSubfiles() or $Directory->getSubdirectories()) {
	$TSunic->Log->alert('error', '{SHOWDELETEFSDIRECTORY__NOTEMPTY}');
	$TSunic->redirect('back');
	return false;
    }

    // activate template
    $data = array('Directory' => $Directory);
    $TSunic->Tmpl->activate('$$$showDeleteFsDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEFSDIRECTORY__TITLE}'));

    return true;
}
?>
