<!-- | FUNCTION show note -->
<?php
function $$$showNote () {
    global $TSunic;

    // get param
    $id_file = $TSunic->Temp->getParameter('$$$id');

    // get File object
    $File = $TSunic->get('$filesystem$File', $id_file);

    // activate template
    $data = array('File' => $File);
    $TSunic->Tmpl->activate('$$$showNote', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWNOTE__TITLE}'));

    return true;
}
?>
