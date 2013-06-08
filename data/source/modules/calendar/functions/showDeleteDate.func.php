<!-- | FUNCTION show page to confirm deletion of date -->
<?php
function $$$showDeleteDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Input->uint('$$$id');
    $Date = $TSunic->get('$$$Date', $id);

    // activate template
    $data = array('Date' => $Date);
    $TSunic->Tmpl->activate('$$$showDeleteDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEDATE__TITLE}'));

    return true;
}
?>
