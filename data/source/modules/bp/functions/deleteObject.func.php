<!-- | FUNCTION delete object -->
<?php
function $$$deleteObject () {
    global $TSunic;

    // get Object object
    $id = $TSunic->Input->uint('$$$id');
    $Object = $TSunic->get('$$$BpObject', $id);
    $backlink = base64_decode($TSunic->Input->param('$$$backlink'));

    // delete tag
    if (!$Object->delete()) {
	$TSunic->Log->alert('error', '{DELETEOBJECT__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEOBJECT__SUCCESS}');
    $TSunic->redirect($backlink, true);

    return true;
}
?>
