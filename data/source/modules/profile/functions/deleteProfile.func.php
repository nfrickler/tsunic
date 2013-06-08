<!-- | FUNCTION delete profile -->
<?php
function $$$deleteProfile () {
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

    // delete profile
    if (!$Profile->delete()) {
	$TSunic->Log->alert('error', '{DELETEPROFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showProfiles');

    return true;
}
?>
