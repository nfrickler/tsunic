<!-- | FUNCTION show form to create profile -->
<?php
function $$$showCreateProfile () {
    global $TSunic;

    // create empty object
    $Profile = $TSunic->get('$$$Profile');

    // activate template
    $data = array(
	'Profile' => $Profile
    );
    $TSunic->Tmpl->activate('$$$showCreateProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEPROFILE__TITLE}'));

    return true;
}
?>
