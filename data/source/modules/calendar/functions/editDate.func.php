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
    $title = $TSunic->Temp->getPost('$$$formDate__title');
    $start_s = $TSunic->Temp->getPost('$$$formDate__start_s');
    $start_i = $TSunic->Temp->getPost('$$$formDate__start_i');
    $start_H = $TSunic->Temp->getPost('$$$formDate__start_H');
    $start_d = $TSunic->Temp->getPost('$$$formDate__start_d');
    $start_m = $TSunic->Temp->getPost('$$$formDate__start_m');
    $start_Y = $TSunic->Temp->getPost('$$$formDate__start_y');
    $stop_s = $TSunic->Temp->getPost('$$$formDate__stop_s');
    $stop_i = $TSunic->Temp->getPost('$$$formDate__stop_i');
    $stop_H = $TSunic->Temp->getPost('$$$formDate__stop_H');
    $stop_d = $TSunic->Temp->getPost('$$$formDate__stop_d');
    $stop_m = $TSunic->Temp->getPost('$$$formDate__stop_m');
    $stop_Y = $TSunic->Temp->getPost('$$$formDate__stop_y');
    $repeat = $TSunic->Temp->getPost('$$$formDate__repeat');
    $repeattype = $TSunic->Temp->getPost('$$$formDate__repeattype');
    $repeatcount = $TSunic->Temp->getPost('$$$formDate__repeatcount');
    $repeatstop_s = $TSunic->Temp->getPost('$$$formDate__repeatstop_s');
    $repeatstop_i = $TSunic->Temp->getPost('$$$formDate__repeatstop_i');
    $repeatstop_H = $TSunic->Temp->getPost('$$$formDate__repeatstop_H');
    $repeatstop_d = $TSunic->Temp->getPost('$$$formDate__repeatstop_d');
    $repeatstop_m = $TSunic->Temp->getPost('$$$formDate__repeatstop_m');
    $repeatstop_Y = $TSunic->Temp->getPost('$$$formDate__repeatstop_y');
    $repeat_radio = $TSunic->Temp->getPost('$$$formDate__repeat_radio');

    $start = mktime($start_H, $start_i, $start_s, $start_m, $start_d, $start_Y);
    $stop = mktime($stop_H, $stop_i, $stop_s, $stop_m, $stop_d, $stop_Y);
    $repeatstop = mktime($repeatstop_H, $repeatstop_i, $repeatstop_s, $repeatstop_m, $repeatstop_d, $repeatstop_Y);

    // evaluate radio selection
    if ($repeat_radio) {
	$repeatstop = 0;
    } else {
	$repeatcount = 0;
    }

    // valid start and stop?
    if (!$start or !$stop or $start > $stop) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDSTARTSTOP}');
	$TSunic->redirect('back');
    }

    // get values from form
    $Helper = $TSunic->get('$bp$Helper');
    $form = $Helper->getFormValues();

    // add idBits to form values
    $form[] = array(
	'fk_tag' => 'DATE__TITLE',
	'fk_bit' => $Date->getBit('DATE__TITLE', true)->getInfo('id'),
	'value' => $title
    );
    $form[] = array(
	'fk_tag' => 'DATE__START',
	'fk_bit' => $Date->getBit('DATE__START', true)->getInfo('id'),
	'value' => $start
    );
    $form[] = array(
	'fk_tag' => 'DATE__STOP',
	'fk_bit' => $Date->getBit('DATE__STOP', true)->getInfo('id'),
	'value' => $stop
    );
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
    $form[] = array(
	'fk_tag' => 'DATE__REPEATCOUNT',
	'fk_bit' => $Date->getBit('DATE__REPEATCOUNT', true)->getInfo('id'),
	'value' => $repeatcount
    );
    $form[] = array(
	'fk_tag' => 'DATE__REPEATSTOP',
	'fk_bit' => $Date->getBit('DATE__REPEATSTOP', true)->getInfo('id'),
	'value' => $repeatstop
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
