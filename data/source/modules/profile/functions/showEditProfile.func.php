<!-- | FUNCTION show page to edit profile -->
<?php
function $$$showEditProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // get preset
    $Date = $TSunic->get('$calendar$Date', $Profile->getInfo('dateofbirth'));
    $preset_dateofbirth = ($Date) ? $Date->getInfo('start') : 0;

    // editable?
    if (!$Profile->editable()) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // activate template
    $data = array(
	'Profile' => $Profile,
	'preset_dateofbirth' => $preset_dateofbirth
    );
    $TSunic->Tmpl->activate('$$$showEditProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWEDITPROFILE__TITLE}'));

    return true;
}
?>
