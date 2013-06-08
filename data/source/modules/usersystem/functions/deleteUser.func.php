<!-- | FUNCTION delete user -->
<?php
function $$$deleteUser () {
    global $TSunic;

    // get User
    $id = $TSunic->Input->uint('$$$id');
    $User = $TSunic->get('$$$User', $id);

    // delete user
    if (!$User->delete()) {
	$TSunic->Log->alert('error', '{DELETEUSER__ERROR}');
	$TSunic->redirect('back', 2);
	return false;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEUSER__SUCCESS}');
    $TSunic->redirect('$$$showUserlist');
    return true;
}
?>
