<!-- | FUNCTION delete object -->
<?php
function $$$deleteObject () {
    global $TSunic;

    // get Object object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Object = $TSunic->get('$$$BpObject', $id);
    $backlink = base64_decode($TSunic->Temp->getParameter('$$$backlink'));

    // delete tag
    if (!$Object->delete()) {
	$TSunic->Log->alert('error', '{DELETEOBJECT__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEOBJECT__SUCCESS}');
    $TSunic->redirect($backlink);

    return true;
}
?>
