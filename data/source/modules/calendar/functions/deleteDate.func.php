<!-- | FUNCTION delete date -->
<?php
function $$$deleteDate () {
    global $TSunic;

    // get Date object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Date = $TSunic->get('$$$Date', $id);

    // delete date
    if (!$Date->delete()) {
	$TSunic->Log->alert('error', '{DELETEDATE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEDATE__SUCCESS}');
    $TSunic->redirect('$$$showIndex');

    return true;
}
?>
