<!-- | FUNCTION delete file -->
<?php
function $$$deleteFile () {
    global $TSunic;

    // get file
    $id = $TSunic->Temp->getParameter('$$$id');
    $File = $TSunic->get('$$$File', $id);
    $parent = $File->getInfo('parent');

    // delete file
    if (!$File->delete()) {
	$TSunic->Log->alert('error', '{DELETEFILE__ERROR}');
	$TSunic->redirect('back', 2);
	return false;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEFILE__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $parent));
    return true;
}
?>
