<!-- | FUNCTION update profile -->
<?php
function $$$updateProfile () {
    global $TSunic;
    $new = false;

    // permission?
    if (!$TSunic->Usr->access('$$$useProfiles')) {
	$TSunic->Log->alert('error', '{$SYSTEM$PERMISSION_DENIED}');
	$TSunic->redirect('back');
    }

    // get profile object
    $id = $TSunic->Input->uint('$$$formProfile__id');
    $Profile = $TSunic->get('$$$Profile', ($id ? $id : 0));

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{UPDATEPROFILE__INVALIDVALUE} ('.
	    $fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create new Profile object?
    if (!$Profile->isValid()) {
	if (!$Profile->create()) {
	    // an error occurred!
	    $TSunic->Log->alert('error', '{UPDATEPROFILE__ERROR}');
	    $TSunic->Log->log('3',
		'profile::createProfile: ERROR: Failed to create new profile');
	    $TSunic->redirect('back');
	    return true;
	}
    }

    // create new Date for birthday
    /*
    if (0 and !$Profile->saveDateofbirth($birthday, '{PROFILE__DATEOFBIRTH__TITLE} "'.$form[0]['value'].' '.$form[1]['value'].'"')) {
	$TSunic->Log->alert('error', '{UPDATEPROFILE__ERROR}');
	$TSunic->Log->log('3', 'profile::updateProfile: ERROR: Failed to save date of birth');
	$TSunic->redirect('back');
    }
    */

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Profile->addeditBit(
	    $values['fk_tag'], $values['fk_bit'], $values['value']
	)) {
	    $TSunic->Log->alert('error', '{UPDATEPROFILE__ERROR}');
	    $TSunic->Log->log('3',
		'profile::updateProfile: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // if MyProfile, share with public
    if ($Profile->getInfo('class') == '$$$MyProfile') {
	$Profile->shareWith_all();
    }

    // success
    $TSunic->Log->alert('info', $new ?
	'{UPDATEPROFILE__CREATE_SUCCESS}' : '{UPDATEPROFILE__EDIT_SUCCESS}');
    $TSunic->redirect('$$$showProfile', array(
	'$$$id' => $Profile->getInfo('id')
    ));
    return true;
}
?>
