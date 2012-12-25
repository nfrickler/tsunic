<!-- | FUNCTION show profile -->
<?php
function $$$showProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // activate template
    $data = array('Profile' => $Profile);
    $TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

    return true;
}
?>
