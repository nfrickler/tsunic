<!-- | FUNCTION show form to edit file -->
<?php
function $$$showEditFile () {
    global $TSunic;

    // get id
    $id = $TSunic->Temp->getParameter('$$$id');

    // create File object
    $File = $TSunic->get('$$$File', $id);

    // activate template
    $data = array(
	'File' => $File
    );
    $TSunic->Tmpl->activate('$$$showEditFile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITFILE__TITLE}'));

    return true;
}
?>
