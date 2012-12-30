<!-- | FUNCTION show form to create selection -->
<?php
function $$$showCreateSelection () {
    global $TSunic;

    // create empty object
    $fk_tag = $TSunic->Temp->getParameter('fk_tag');
    $Selection = $TSunic->get('$$$Selection');

    // activate template
    $data = array(
	'fk_tag' => $fk_tag,
	'Selection' => $Selection
    );
    $TSunic->Tmpl->activate('$$$showCreateSelection', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATESELECTION__TITLE}'));

    return true;
}
?>
