<!-- | FUNCTION show profile -->
<?php
function $$$showProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Input->uint('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // is MyProfile?
    $is_MyProfile = ($Profile->getInfo('class') == '$$$MyProfile')
	? true : false;
    if ($is_MyProfile) $Profile = $TSunic->get('$$$MyProfile', $id);

    // permission?
    if (!$is_MyProfile and !$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // activate template
    $data = array(
	'Profile' => $Profile,
	'showDelete' => ((!$is_MyProfile and $Profile->editable()) ? true : false),
	'h1' => '{SHOWPROFILE__H1}',
	'infotext' => '',
    );
    $TSunic->Tmpl->activate('$$$showProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWPROFILE__TITLE}'));

    return true;
}
?>
