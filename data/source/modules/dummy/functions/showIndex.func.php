<!-- | FUNCTION show index -->
<?php
function $$$showIndex () {
    global $TSunic;

    // get some parameter
    $id = $TSunic->Temp->getParameter('$$$id');

    // activate template
    $data = array('mydata' => 'Here you can push some data to your template');
    $TSunic->Tmpl->activate('$$$showIndex', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWINDEX__TITLE}'));

    return true;
}
?>
