<!-- | FUNCTION edit profile data -->
<?php
function $$$editIssue () {
    global $TSunic;

    // get profile object
    $id = $TSunic->Temp->getPost('$$$formIssue__id');
    $Issue = $TSunic->get('$$$Issue', $id);

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{EDITISSUE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // is valid profile?
    if (!$Issue->isValid()) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{EDITISSUE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Issue->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{EDITISSUE__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{EDITISSUE__SUCCESS}');
    $TSunic->redirect('$$$showIssue', array('$$$id' => $Issue->getInfo('id')));
    return true;
}
?>
