<!-- | FUNCTION create profile -->
<?php
function $$$createProfile () {
    global $TSunic;

    // get input
    $firstname = $TSunic->Temp->getPost('$$$formProfile__firstname');
    $lastname = $TSunic->Temp->getPost('$$$formProfile__lastname');
    $dateofbirth = $TSunic->Temp->getPost('$$$formProfile__dateofbirth');

    // create profile object
    $Profile = $TSunic->get('$$$Profile', 0);

    // create profile
    $return = $Profile->create();

    // check, if create successful
    if (!$return) {
	// add error-message and redirect back
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // save bits
    $bits = array(
	'PROFILE__FIRSTNAME' => $firstname,
	'PROFILE__LASTNAME' => $lastname,
	'PROFILE__DATEOFBIRTH' => $dateofbirth,
    );
    foreach ($bits as $index => $value) {
	if (!$Profile->addPiece(0, $index, $value)) {
	    $TSunic->Log->alert('error', '{CREATEPROFILE__INVALID} ('.$index.')');
	    $TSunic->redirect('back');
	    return true;
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showProfile', array('$$$id' => $Profile->getInfo('id')));
    return true;
}
?>
