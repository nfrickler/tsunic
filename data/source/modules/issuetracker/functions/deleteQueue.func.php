<!-- | FUNCTION delete queue -->
<?php
function $$$deleteQueue () {
    global $TSunic;

    // get Queue object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Queue = $TSunic->get('$$$Queue', $id);

    // delete queue
    if (!$Queue->delete()) {
	$TSunic->Log->alert('error', '{DELETEQUEUE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEQUEUE__SUCCESS}');
    $TSunic->redirect('$$$showQueues');

    return true;
}
?>
