<!-- | FUNCTION create new date to object -->
<?php
function $$$createDate () {
    global $TSunic;

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

    // get Date object
    $Date = $TSunic->get('$$$Date');

    // valid input?
    if (!$Date->isValidTitle($title)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDTITLE}');
	$TSunic->redirect('back');
    }
    if (!$start or !$stop or $start > $stop) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDSTARTSTOP}');
	$TSunic->redirect('back');
    }
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

    // create new date
    if (!$Date->create()) {
	$TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
	$TSunic->redirect('back');
    }

    // add tags to date
    if ($Date->addBit($title, 'DATE__TITLE') and
	$Date->addBit($start, 'DATE__START') and
	$Date->addBit($stop, 'DATE__STOP') and
	$Date->addBit($repeat, 'DATE__REPEAT') and
	$Date->addBit($repeatstop, 'DATE__REPEATSTOP') and
	$Date->addBit($repeat, 'DATE__REPEAT') and
	$Date->addBit($repeattype, 'DATE__REPEATTYPE') and
	$Date->addBit($repeatcount, 'DATE__REPEATCOUNT') and
	$Date->addBit($repeatstop, 'DATE__REPEATSTOP')
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
