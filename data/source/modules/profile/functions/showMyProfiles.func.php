<!-- | FUNCTION show all users (MyProfiles) -->
<?php
function $$$showMyProfiles () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('$$$showMyProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get all profiles
    $Helper = $TSunic->get('$bp$Helper');
    $profiles = $Helper->getObjects('$$$MyProfile');

    // activate template
    $data = array(
	'profiles' => $profiles,
    );
    $TSunic->Tmpl->activate('$$$showMyProfiles', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWMYPROFILES__TITLE}'));

    return true;
}
?>
