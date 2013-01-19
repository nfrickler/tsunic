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
    $period = $TSunic->Temp->getPost('$$$formDate__period');
    $periodtype = $TSunic->Temp->getPost('$$$formDate__periodtype');
    $start = mktime($start_H, $start_i, $start_s, $start_m, $start_d, $start_Y);
    $stop = mktime($stop_H, $stop_i, $stop_s, $stop_m, $stop_d, $stop_Y);

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
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__PERIOD'));
    if (!$Tag->isValidValue($period)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDPERIOD}');
	$TSunic->redirect('back');
    }
    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__PERIODTYPE'));
    if (!$Tag->isValidValue($periodtype)) {
	$TSunic->Log->alert('error', '{CREATEDATE__INVALIDPERIODTYPE}');
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
	$Date->addBit($period, 'DATE__PERIOD') and
	$Date->addBit($periodtype, 'DATE__PERIODTYPE')
    ) {
	// success
	$TSunic->Log->alert('info', '{CREATEDATE__SUCCESS}');
	$TSunic->redirect('$$$showDay', array(
	    '$$$year' => date('Y', $start),
	    '$$$month' => date('m', $start),
	    '$$$day' => date('d', $start)
	));
	return true;
    }

    // add error message and redirect back
    $TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
