<!-- | FUNCTION create new date to object -->
<?php
function $$$createDate () {
    global $TSunic;

    // get input
    $repeat = $TSunic->Input->post('$$$formDate__repeat');
    $repeattype = $TSunic->Input->post('$$$formDate__repeattype');
    $repeat_radio = $TSunic->Input->post('$$$formDate__repeat_radio');

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // get Date object
    $Date = $TSunic->get('$$$Date');

    // valid input?
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEAT'));
    if (!$Tag->isValidValue($repeat)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDREPEAT}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEATTYPE'));
    if (!$Tag->isValidValue($repeattype)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDREPEATTYPE}');
	$TSunic->redirect('back');
    }

    // evaluate radio selection
    if ($repeat_radio) {
	foreach ($form as $index => $values) {
	    if ($values['fk_tag'] == $Helper->tag2id('DATE__REPEATSTOP')) {
		$form[$index]['value'] = NULL;
	    }
	}
    } else {
	foreach ($form as $index => $values) {
	    if ($values['fk_tag'] == $Helper->tag2id('DATE__REPEATCOUNT')) {
		$form[$index]['value'] = NULL;
	    }
	}
    }

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // create new date
    if (!$Date->create()) {
	$TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Date->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
	    $TSunic->Log->log('3', 'date::createDate: ERROR: Failed to add bit');
	    $TSunic->redirect('back');
	}
    }

    // add tags to date
    if ($Date->addBit($repeat, 'DATE__REPEAT') and
	$Date->addBit($repeattype, 'DATE__REPEATTYPE')
    ) {
	// success
	$TSunic->Log->alert('info', '{CREATEDATE__SUCCESS}');
	$TSunic->redirect('$$$showDay', array('$$$time' => $start));
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
