<!-- | FUNCTION delete profile -->
<?php
function $$$deleteProfile () {
    global $TSunic;

    // get Profile object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Profile = $TSunic->get('$$$Profile', $id);

    // delete profile
    if (!$Profile->delete()) {
	$TSunic->Log->alert('error', '{DELETEPROFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showIndex');

    return true;
}
?>
