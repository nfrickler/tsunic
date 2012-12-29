<!-- | FUNCTION delete selection -->
<?php
function $$$showDeleteSelection () {
    global $TSunic;

    // get Selection object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Selection = $TSunic->get('$$$Selection', $id);

    // activate template
    $data = array('Selection' => $Selection);
    $TSunic->Tmpl->activate('$$$showDeleteSelection', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETESELECTION__TITLE}'));

    return true;
}
?>
