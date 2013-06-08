<!-- | FUNCTION show form to edit filesystem directory -->
<?php
function $$$showEditDirectory () {
    global $TSunic;

    // get id
    $id = $TSunic->Input->uint('$$$id');

    // create empty object
    $Directory = $TSunic->get('$$$Directory', $id);

    // activate template
    $data = array(
	'Directory' => $Directory
    );
    $TSunic->Tmpl->activate('$$$showEditDirectory', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITDIRECTORY__TITLE}'));

    return true;
}
?>
