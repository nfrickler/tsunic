<!-- | function to ask, if mail shall be deleted -->
<?php
function $$$showDeleteMail () {
    global $TSunic;

    // get Mail object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Mail = $TSunic->get('$$$Mail', $id);

    // activate template
    $data = array('Mail' => $Mail);
    $TSunic->Tmpl->activate('$$$showDeleteMail', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEMAIL__TITLE}'));

    return true;
}
?>
