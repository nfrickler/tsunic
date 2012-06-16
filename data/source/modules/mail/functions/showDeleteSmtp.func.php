<!-- | function to ask, if SMTP shall be deleted -->
<?php
function $$$showDeleteSmtp () {
    global $TSunic;

    // get Smtp object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Smtp = $TSunic->get('$$$Smtp', $id);

    // activate template
    $data = array('Smtp' => $Smtp);
    $TSunic->Tmpl->activate('$$$showDeleteSmtp', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETESMTP__TITLE}'));

    return true;
}
?>
