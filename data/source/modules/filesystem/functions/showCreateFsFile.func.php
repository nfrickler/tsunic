<!-- | FUNCTION show form to create filesystem file -->
<?php
function $$$showCreateFsFile () {
    global $TSunic;

    // get directory
    $fk_directory = $TSunic->Temp->getParameter('fk_directory');

    // create empty object
    $File = $TSunic->get('$$$FsFile');
    $Dir = $TSunic->get('$$$FsDirectory');

    // activate template
    $data = array(
	'File' => $File,
	'directories' => $Dir->allDirectories(),
	'fk_directory' => $fk_directory,
    );
    $TSunic->Tmpl->activate('$$$showCreateFsFile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEFSFILE__TITLE}'));

    return true;
}
?>
