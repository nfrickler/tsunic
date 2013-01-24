<!-- | FUNCTION edit date data -->
<?php
function $$$editDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Temp->getPost('$$$formDate__id');
    $Date = $TSunic->get('$$$Date', $id);
    if (!$Date->isValid()) {
	$TSunic->Log->alert('error', '{EDITDATE__ERROR}');
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

    // valid input?
    if (!$Date->isValidTitle($title)) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDTITLE}');
	$TSunic->redirect('back');
    }
    if (!$start or !$stop or $start > $stop) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDSTARTSTOP}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEAT'));
    if (!$Tag->isValidValue($repeat)) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDREPEAT}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEATTYPE'));
    if (!$Tag->isValidValue($repeattype)) {
	$TSunic->Log->alert('error', '{EDITDATE__INVALIDREPEATTYPE}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEATCOUNT'));
    if (!$Tag->isValidValue($repeatcount)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDREPEATCOUNT}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEATSTOP'));
    if (!$Tag->isValidValue($repeatstop)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDREPEATSTOP}');
	$TSunic->redirect('back');
    }

    // add tags to date
    if (!$Date->addBit($title, 'DATE__TITLE') or
	!$Date->addBit($start, 'DATE__START') or
	!$Date->addBit($stop, 'DATE__STOP') or
	!$Date->addBit($repeat, 'DATE__REPEAT') or
	!$Date->addBit($repeattype, 'DATE__REPEATTYPE') or
	!$Date->addBit($repeatcount, 'DATE__REPEATCOUNT') or
	!$Date->addBit($repeatstop, 'DATE__REPEATSTOP')
    ) {
	$TSunic->Log->alert('error', '{EDITDATE__ERROR}');
	$TSunic->redirect('back');
    }

    // get all posts
    $posts = $TSunic->Temp->getPost(true);

    // get all fk_tags, fk_bits and values
    $fk_tags = array();
    $fk_bits = array();
    $values = array();
    foreach ($posts as $index => $value) {
	$cache = explode('__', $index);
	if (count($cache) != 4 or $cache[1] != 'formBit') continue;

	// get values
	switch ($cache[2]) {
	    case 'fk_tag':
		$fk_tags[$cache[3]] = $value;
		break;
	    case 'fk_bit':
		$fk_bits[$cache[3]] = $value;
		break;
	    case 'value':
		$values[$cache[3]] = $value;
		break;
	    default:
		// skip
		break;
	}
    }

    // validate input
    foreach ($values as $index => $value) {
	$Tag = $TSunic->get('$bp$Tag', $fk_tags[$index]);
	if (!$Tag->isValidValue($value)) {
	    $TSunic->Log->alert('error', '{EDITDATE__INVALIDVALUE} (tag: '.$Tag->getInfo('name').', value: '.$value.')');
	    $TSunic->redirect('back');
	}
    }

    // create date object
    $id = $TSunic->Temp->getPost('$$$formDate__id');
    $Date = $TSunic->get('$$$Date', $id);

    // create date
    if (!$Date->isValid()) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{EDITDATE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // add/edit all bits
    foreach ($values as $index => $value) {

	// exists?
	if ($fk_bits[$index]) {
	    $Bit = $TSunic->get('$bp$Bit', $fk_bits[$index]);
	    if (!$Bit->edit($value)) {
		$TSunic->Log->alert('error', '{EDITDATE__ERROR}');
		$TSunic->redirect('back');
	    }
	    continue;
	}

	// create new Bit
	if (!$Date->addBit($value, $fk_tags[$index])) {
	    $TSunic->Log->alert('error', '{EDITDATE__ERROR}');
	    $TSunic->redirect('back');
	}
    }

    // success
    $TSunic->Log->alert('info', '{EDITDATE__SUCCESS}');
    $TSunic->redirect('$$$showDay', array('$$$time' => $start));
    return true;
}
?>
