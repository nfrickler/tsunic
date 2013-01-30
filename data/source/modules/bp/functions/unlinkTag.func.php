<!-- | FUNCTION unlink tag -->
<?php
function $$$unlinkTag () {
    global $TSunic;

    // get backlink
    $backlink = base64_decode($TSunic->Temp->getParameter('$$$backlink'));

    // get Bit object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Bit = $TSunic->get('$$$Bit', $id);

    // delete Bit
    if (!$Bit->delete()) {
	$TSunic->Log->alert('error', '{UNLINKTAG__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{UNLINKTAG__SUCCESS}');
    $TSunic->redirect($backlink, true);

    return true;
}
?>
