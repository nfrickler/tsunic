<!-- | FUNCTION show content of filesystem directory -->
<?php
function $$$showIndex() {
    global $TSunic;

    // get directory id
    $id = $TSunic->Temp->getParameter('$$$id');
    $Dir = $TSunic->get('$$$FsDirectory', $id);

    // activate template
    $data = array('Directory' => $Dir);
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
