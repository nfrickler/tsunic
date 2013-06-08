<!-- | FUNCTION show page to confirm issue deletion -->
<?php
function $$$showDeleteIssue () {
    global $TSunic;

    // get Issue object
    $id = $TSunic->Input->uint('$$$id');
    $Issue = $TSunic->get('$$$Issue', $id);

    // activate template
    $data = array('Issue' => $Issue);
    $TSunic->Tmpl->activate('$$$showDeleteIssue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEISSUE__TITLE}'));

    return true;
}
?>
