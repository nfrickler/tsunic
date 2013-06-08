<!-- | FUNCTION unlink tag -->
<?php
function $$$unlinkTag () {
    global $TSunic;

    // get backlink
    $backlink = base64_decode($TSunic->Input->param('$$$backlink'));

    // get Bit object
    $id = $TSunic->Input->uint('$$$id');
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
