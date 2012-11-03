<!-- | FUNCTION show form to edit filesystem directory -->
<?php
function $$$showEditFsDirectory () {
    global $TSunic;

    // get id
    $id = $TSunic->Temp->getParameter('$$$id');

    // create empty object
    $Directory = $TSunic->get('$$$FsDirectory', $id);

    // get all directories valid as parent directory
    $directories = array();
    foreach ($Directory->allDirectories() as $index => $value) {
	if ($Directory->isValidParent($index)) $directories[$index] = $value;
    }

    // activate template
    $data = array(
	'Directory' => $Directory,
	'directories' => $directories,
    );
    $TSunic->Tmpl->activate('$$$showEditFsDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITFSDIRECTORY_TITLE}'));

    return true;
}
?>
