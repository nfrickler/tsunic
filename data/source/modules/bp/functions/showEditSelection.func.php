<!-- | FUNCTION show page to edit selection -->
<?php
function $$$showEditSelection () {
    global $TSunic;

    // get Selection object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Selection = $TSunic->get('$$$Selection', $id);

    // activate template
    $data = array('Selection' => $Selection);
    $TSunic->Tmpl->activate('$$$showEditSelection', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITSELECTION__TITLE}'));

    return true;
}
?>
