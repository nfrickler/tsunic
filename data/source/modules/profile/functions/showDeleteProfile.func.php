<!-- | FUNCTION show page to confirm profile deletion -->
<?php
function $$$showDeleteProfile () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get Profile object
    $id = $TSunic->Input->uint('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // editable?
    if (!$Profile->editable()) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // activate template
    $data = array('Profile' => $Profile);
    $TSunic->Tmpl->activate('$$$showDeleteProfile', '$system$content', $data);
    $TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEPROFILE__TITLE}'));

    return true;
}
?>
