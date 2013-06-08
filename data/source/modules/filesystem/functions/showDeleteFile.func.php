<!-- | FUNCTION show page to confirm deletion of file -->
<?php
function $$$showDeleteFile () {
    global $TSunic;

    // get File
    $id = $TSunic->Input->uint('$$$id');
    $File = $TSunic->get('$$$File', $id);

    // activate template
    $data = array('File' => $File);
    $TSunic->Tmpl->activate('$$$showDeleteFile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEFILE__TITLE}'));

    return true;
}
?>
