<!-- | FUNCTION show note -->
<?php
function $$$showNote () {
    global $TSunic;

    // get param
    $id_fsfile = $TSunic->Temp->getParameter('$$$id');

    // get FsFile object
    $FsFile = $TSunic->get('$usersystem$FsFile', $id_fsfile);

    // activate template
    $data = array('FsFile' => $FsFile);
    $TSunic->Tmpl->activate('$$$showNote', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWNOTE__TITLE}'));

    return true;
}
?>
