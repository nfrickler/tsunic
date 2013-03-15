<!-- | FUNCTION create queue -->
<?php
function $$$createQueue () {
    global $TSunic;

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEQUEUE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create new Queue object
    $Queue = $TSunic->get('$$$Queue', 0);
    if (!$Queue->create()) {
	// an error occurred!
	$TSunic->Log->alert('error', '{CREATEQUEUE__ERROR}');
	$TSunic->Log->log('3',
	    'issue::createQueue: ERROR: Failed to create new queue');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Queue->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEQUEUE__ERROR}');
	    $TSunic->Log->log('3', 'issue::createQueue: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // push to guest user
    if (!$Queue->pushTo($TSunic->Usr->getIdGuest())) {
	$TSunic->Log->alert('error', '{CREATEQUEUE__ERROR}');
	$TSunic->Log->log('3', 'issue::createQueue: ERROR: Failed to push to guest');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{CREATEQUEUE__SUCCESS}');
    $TSunic->redirect('$$$showQueue', array('$$$id' => $Queue->getInfo('id')));
    return true;
}
?>
