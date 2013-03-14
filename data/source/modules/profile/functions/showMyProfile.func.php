<!-- | FUNCTION show MyProfile -->
<?php
function $$$showMyProfile () {
    global $TSunic;

    // get MyProfile object
    $Meta = $TSunic->get('$$$Meta');
    $MyProfile = $Meta->getMyProfile();

    // activate template
    $data = array(
	'Profile' => $MyProfile,
	'showDelete' => false,
	'h1' => '{SHOWMYPROFILE__H1}',
	'infotext' => '{SHOWMYPROFILE__INFOTEXT}',
    );
    $TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

    return true;
}
?>
