<!-- | FUNCTION show page to edit queue -->
<?php
function $$$showEditQueue () {
    global $TSunic;

    // get Queue object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Queue = $TSunic->get('$$$Queue', $id);

    // activate template
    $data = array(
	'Queue' => $Queue,
    );
    $TSunic->Tmpl->activate('$$$showEditQueue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITQUEUE__TITLE}'));

    return true;
}
?>
