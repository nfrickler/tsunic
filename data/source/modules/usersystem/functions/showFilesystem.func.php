<!-- | FUNCTION show content of filesystem -->
<?php
function $$$showFilesystem () {
    global $TSunic;

    // get current directory
    $path = $TSunic->Temp->getParameter('$$$path');
    $Dir = $TSunic->get('$$$FsDirectory', $path);

    // activate template
    $data = array('Directory' => $Dir);
    $TSunic->Tmpl->activate('$$$showFilesystem', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWFILESYSTEM__TITLE}'));

    return true;
}
?>
