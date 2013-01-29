<!-- | FUNCTION show form to create profile -->
<?php
function $$$showCreateProfile () {
    global $TSunic;

    // create empty object
    $Profile = $TSunic->get('$$$Profile');

    // get preset
    $preset_dateofbirth = time();

    // activate template
    $data = array(
	'Profile' => $Profile,
	'preset_dateofbirth' => $preset_dateofbirth
    );
    $TSunic->Tmpl->activate('$$$showCreateProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWCREATEPROFILE__TITLE}'));

    return true;
}
?>
