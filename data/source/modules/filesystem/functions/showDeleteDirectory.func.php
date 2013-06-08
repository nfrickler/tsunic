<!-- | FUNCTION show page to confirm deletion of directory -->
<?php
function $$$showDeleteDirectory () {
    global $TSunic;

    // get Directory
    $id = $TSunic->Input->uint('$$$id');
    $Directory = $TSunic->get('$$$Directory', $id);

    // is empty directory?
    if ($Directory->getSubfiles() or $Directory->getSubdirectories()) {
	$TSunic->Log->alert('error', '{SHOWDELETEDIRECTORY__NOTEMPTY}');
	$TSunic->redirect('back');
	return false;
    }

    // activate template
    $data = array('Directory' => $Directory);
    $TSunic->Tmpl->activate('$$$showDeleteDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEDIRECTORY__TITLE}'));

    return true;
}
?>
