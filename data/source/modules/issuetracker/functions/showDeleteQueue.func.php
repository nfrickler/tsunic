<!-- | FUNCTION show page to confirm queue deletion -->
<?php
function $$$showDeleteQueue () {
    global $TSunic;

    // get Queue object
    $id = $TSunic->Input->uint('$$$id');
    $Queue = $TSunic->get('$$$Queue', $id);

    // activate template
    $data = array('Queue' => $Queue);
    $TSunic->Tmpl->activate('$$$showDeleteQueue', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEQUEUE__TITLE}'));

    return true;
}
?>
