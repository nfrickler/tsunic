<!-- | FUNCTION edit Date object -->
<?php
function $$$editDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Temp->getPost('$$$formDate__id');
    $Date = $TSunic->get('$$$Date', $id);
    if (!$Date->isValid()) {
	$TSunic->Log->alert('error', '{EDITDATE__ERROR}');
	$TSunic->Log->log(3, "calendar::editDate: ERROR: Could not get Date object");
	$TSunic->redirect('back');
    }

    // get input
    $repeat = $TSunic->Temp->getPost('$$$formDate__repeat');
    $repeattype = $TSunic->Temp->getPost('$$$formDate__repeattype');
    $repeat_radio = $TSunic->Temp->getPost('$$$formDate__repeat_radio');

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

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

    // add idBits to form values
    $form[] = array(
	'fk_tag' => 'DATE__REPEAT',
	'fk_bit' => $Date->getBit('DATE__REPEAT', true)->getInfo('id'),
	'value' => $repeat
    );
    $form[] = array(
	'fk_tag' => 'DATE__REPEATTYPE',
	'fk_bit' => $Date->getBit('DATE__REPEATTYPE', true)->getInfo('id'),
	'value' => $repeattype
    );

    // validate input
    $fail = $Helper->validateFormValues($form);
    if ($fail) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDVALUE} ('.$fail['tagname'].': '.$fail['value'].')');
	$TSunic->redirect('back');
    }

    // add/edit all bits
    foreach ($form as $index => $values) {
	if (!$Date->addeditBit($values['fk_tag'], $values['fk_bit'], $values['value'])) {
	    $TSunic->Log->alert('error', '{EDITDATE__ERROR}');
	    $TSunic->Log->log(3, "calendar::editDate: ERROR: addedit all Bits failed");
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{EDITDATE__SUCCESS}');
    $TSunic->redirect('$$$showDay', array('$$$time' => $start));
    return true;
}
?>
