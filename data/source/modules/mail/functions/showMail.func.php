<!-- | FUNCTION show mail -->
<?php
function $$$showMail () {
    global $TSunic;

    // get mail object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Mail = $TSunic->get('$$$Mail', array($id));

    // set mail to seen
    $Mail->setSeen();

    // activate template
    $data = array('Mail' => $Mail);
    $TSunic->Tmpl->activate('$$$showMail', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMAIL__TITLE}'));

    return true;
}
?>
