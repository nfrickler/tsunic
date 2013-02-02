<!-- | FUNCTION show form to edit filesystem directory -->
<?php
function $$$showEditDirectory () {
    global $TSunic;

    // get id
    $id = $TSunic->Temp->getParameter('$$$id');

    // create empty object
    $Directory = $TSunic->get('$$$Directory', $id);

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
    $TSunic->Tmpl->activate('$$$showEditDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITDIRECTORY_TITLE}'));

    return true;
}
?>
