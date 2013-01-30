<!-- | FUNCTION save chosen object in Bit -->
<?php
function $$$chooseObject () {
    global $TSunic;

    // get input
    $fk_bit = $TSunic->Temp->getPost('$$$formChooseObject__fk_bit');
    $fk_obj = $TSunic->Temp->getPost('$$$formChooseObject__fk');
    $backlink = base64_decode($TSunic->Temp->getPost('$$$formChooseObject__backlink'));
    if (!$backlink) $backlink = '?back=2';

    // get Bit object
    $Bit = $TSunic->get('$$$Bit', $fk_bit);
    if (!$Bit->isValid()) {
	$TSunic->Log->alert('error', '{CHOOSEOBJECT__ERROR}');
	$TSunic->redirect('back');
    }

    // save chosen object in Bit
    if (!$Bit->edit($fk_obj)) {
	$TSunic->Log->alert('error', '{CHOOSEOBJECT__ERROR}');
	$TSunic->redirect('back');
    }

    // success
    $TSunic->Log->alert('info', '{CHOOSEOBJECT__SUCCESS}');
    $TSunic->redirect($backlink, true);
    return true;
}
?>
