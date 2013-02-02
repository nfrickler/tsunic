<!-- | FUNCTION create profile -->
<?php
function $$$createProfile () {
    global $TSunic;

    // get input
    $dateofbirth_d = $TSunic->Temp->getPost('$$$formProfile__dateofbirth_d');
    $dateofbirth_m = $TSunic->Temp->getPost('$$$formProfile__dateofbirth_m');
    $dateofbirth_Y = $TSunic->Temp->getPost('$$$formProfile__dateofbirth_y');
    $dateofbirth = mktime(0, 0, 0, $dateofbirth_m, $dateofbirth_d, $dateofbirth_Y);

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEPROFILE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create profile object
    $Profile = $TSunic->get('$$$Profile', 0);

    // create profile
    if (!$Profile->create()) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // create new Date for dateofbirth
    if (!$Profile->saveDateofbirth($dateofbirth, '{PROFILE__DATEOFBIRTH__TITLE} "'.$form[0]['value'].' '.$form[1]['value'].'"')) {
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Profile->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showProfile', array('$$$id' => $Profile->getInfo('id')));
    return true;
}
?>
