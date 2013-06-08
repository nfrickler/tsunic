<!-- | FUNCTION delete tag? -->
<?php
function $$$showDeleteTag () {
    global $TSunic;

    // get Tag object
    $id = $TSunic->Input->uint('$$$id');
    $Tag = $TSunic->get('$$$Tag', $id);

    // activate template
    $data = array('Tag' => $Tag);
    $TSunic->Tmpl->activate('$$$showDeleteTag', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETETAG__TITLE}'));

    return true;
}
?>
