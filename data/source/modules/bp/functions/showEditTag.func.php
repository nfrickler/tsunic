<!-- | FUNCTION show page to edit tag -->
<?php
function $$$showEditTag () {
    global $TSunic;

    // get Tag object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Tag = $TSunic->get('$$$Tag', $id);

    // activate template
    $data = array('Tag' => $Tag);
    $TSunic->Tmpl->activate('$$$showEditTag', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITTAG__TITLE}'));

    return true;
}
?>
