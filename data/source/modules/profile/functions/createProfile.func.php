<!-- | FUNCTION create profile -->
<?php
function $$$createProfile () {
    global $TSunic;

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEPROFILE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create new Profile object
    $Profile = $TSunic->get('$$$Profile', 0);
    if (!$Profile->create()) {
	// an error occurred!
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->Log->log('3',
	    'profile::createProfile: ERROR: Failed to create new profile');
	$TSunic->redirect('back');
	return true;
    }

    // create new Date for birthday
    if (0 and !$Profile->saveDateofbirth($birthday, '{PROFILE__DATEOFBIRTH__TITLE} "'.$form[0]['value'].' '.$form[1]['value'].'"')) {
	$TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	$TSunic->Log->log('3', 'profile::createProfile: ERROR: Failed to save date of birth');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Profile->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEPROFILE__ERROR}');
	    $TSunic->Log->log('3', 'profile::createProfile: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEPROFILE__SUCCESS}');
    $TSunic->redirect('$$$showProfile', array('$$$id' => $Profile->getInfo('id')));
    return true;
}
?>
