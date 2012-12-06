<!-- | FUNCTION edit profile data -->
<?php
function $$$editProfile () {
    global $TSunic;

    // get input
    $id = $TSunic->Temp->getPost('$$$formProfile__id');
    $firstname = $TSunic->Temp->getPost('$$$formProfile__firstname');

    // get Profile object
    $Profile = $TSunic->get('$$$Profile', $id);

    // validate input
    if (!$Profile->isValidFirstname($firstname)) {
	// invalid firstname
	$TSunic->Log->alert('error', '{EDITPROFILE__INVALIDFIRSTNAME}');
	$TSunic->redirect('back');
    }

    // edit profile
    if ($Profile->edit($firstname)) {
	// success
	$TSunic->Log->alert('info', '{EDITPROFILE__SUCCESS}');
	$TSunic->redirect('$$$showProfile', array('id' => $id));
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{EDITPROFILE__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
