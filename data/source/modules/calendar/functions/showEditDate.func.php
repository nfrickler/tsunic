<!-- | FUNCTION show page to edit date -->
<?php
function $$$showEditDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Date = $TSunic->get('$$$Date', $id);

    // activate template
    $data = array('Date' => $Date);
    $TSunic->Tmpl->activate('$$$showEditDate', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITDATE__TITLE}'));

    return true;
}
?>
