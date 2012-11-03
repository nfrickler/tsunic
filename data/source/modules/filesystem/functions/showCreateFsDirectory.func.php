<!-- | FUNCTION show form to create filesystem directory -->
<?php
function $$$showCreateFsDirectory () {
    global $TSunic;

    // get parent
    $fk_parent = $TSunic->Temp->getParameter('fk_parent');

    // create empty object
    $Directory = $TSunic->get('$$$FsDirectory');

    // activate template
    $data = array(
	'Directory' => $Directory,
	'directories' => $Directory->allDirectories(),
	'fk_parent' => $fk_parent,
    );
    $TSunic->Tmpl->activate('$$$showCreateFsDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEFSDIRECTORY__TITLE}'));

    return true;
}
?>
