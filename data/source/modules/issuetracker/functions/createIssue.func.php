<!-- | FUNCTION create issue -->
<?php
function $$$createIssue () {
    global $TSunic;

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEISSUE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create new Issue object
    $Issue = $TSunic->get('$$$Issue', 0);
    if (!$Issue->create()) {
	// an error occurred!
	$TSunic->Log->alert('error', '{CREATEISSUE__ERROR}');
	$TSunic->Log->log('3',
	    'issue::createIssue: ERROR: Failed to create new issue');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Issue->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEISSUE__ERROR}');
	    $TSunic->Log->log('3', 'issue::createIssue: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // share issue with maintainer
    $maintainer = $Issue->getByTag("ISSUE__MAINTAINER");
	    $TSunic->Log->log(1, 'issue::createIssue: maintainer= '.$maintainer);
    if ($maintainer) {
	$Maintainer = $TSunic->get('$profile$MyProfile', $maintainer);
	//TODO
	    $TSunic->Log->log(1, 'issue::createIssue: share!');
	if (!$Issue->shareWith($Maintainer->getInfo('account'),1)) {
	    $TSunic->Log->alert('error', '{CREATEISSUE__ERROR}');
	    $TSunic->Log->log(3, 'issue::createIssue: ERROR: Failed to share issue with other user');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{CREATEISSUE__SUCCESS}');
    $TSunic->redirect('$$$showIssue', array('$$$id' => $Issue->getInfo('id')));
    return true;
}
?>
