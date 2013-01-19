<!-- | FUNCTION create new date to object -->
<?php
function $$$createDate () {
    global $TSunic;

    // get input
    $title = $TSunic->Temp->getPost('$$$formAddDate__title');
    $start_s = $TSunic->Temp->getPost('$$$formAddDate__start_s');
    $start_i = $TSunic->Temp->getPost('$$$formAddDate__start_i');
    $start_H = $TSunic->Temp->getPost('$$$formAddDate__start_H');
    $start_d = $TSunic->Temp->getPost('$$$formAddDate__start_d');
    $start_m = $TSunic->Temp->getPost('$$$formAddDate__start_m');
    $start_y = $TSunic->Temp->getPost('$$$formAddDate__start_y');
    $stop_s = $TSunic->Temp->getPost('$$$formAddDate__stop_s');
    $stop_i = $TSunic->Temp->getPost('$$$formAddDate__stop_i');
    $stop_H = $TSunic->Temp->getPost('$$$formAddDate__stop_H');
    $stop_d = $TSunic->Temp->getPost('$$$formAddDate__stop_d');
    $stop_m = $TSunic->Temp->getPost('$$$formAddDate__stop_m');
    $stop_y = $TSunic->Temp->getPost('$$$formAddDate__stop_y');
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

    // create new date
    $Date->create();

    // add tags to date
    if (!$Date->addBit($title, 'DATE__TITLE')) {
	// add error message and redirect back
	$TSunic->Log->alert('error', '{CREATEDATE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{CREATEDATE__SUCCESS}');
    $TSunic->redirect('$$$showDay', array());
    return true;
}
?>
