<!-- | FUNCTION show page to edit profile -->
<?php
function $$$showEditProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // activate template
    $data = array('Profile' => $Profile);
    $TSunic->Tmpl->activate('$$$showEditProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITPROFILE__TITLE}'));

    return true;
}
?>
