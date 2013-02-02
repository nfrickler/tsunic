<!-- | FUNCTION show form to create filesystem directory -->
<?php
function $$$showCreateDirectory () {
    global $TSunic;

    // get parent
    $parent_preset = $TSunic->Temp->getParameter('fk_parent');

    // create empty object
    $Directory = $TSunic->get('$$$Directory');

    // activate template
    $data = array(
	'Directory' => $Directory,
	'directories' => $Directory->allDirectories(),
	'parent_preset' => $parent_preset,
    );
    $TSunic->Tmpl->activate('$$$showCreateDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEDIRECTORY__TITLE}'));

    return true;
}
?>
