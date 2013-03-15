<!-- | FUNCTION show profiles -->
<?php
function $$$showProfiles () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get all profiles
    $Helper = $TSunic->get('$bp$Helper');
    $profiles = $Helper->getObjects('$$$Profile');

    // activate template
    $data = array(
	'profiles' => $profiles,
    );
    $TSunic->Tmpl->activate('$$$showProfiles', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILES__TITLE}'));

    return true;
}
?>
