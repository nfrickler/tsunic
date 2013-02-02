<!-- | FUNCTION delete directory -->
<?php
function $$$deleteDirectory () {
    global $TSunic;

    // get directory
    $id = $TSunic->Temp->getParameter('$$$id');
    $Directory = $TSunic->get('$$$Directory', $id);
    $fk_parent = $Directory->getInfo('fk_parent');

    // delete directory
    if (!$Directory->delete()) {
	$TSunic->Log->alert('error', '{DELETEDIRECTORY__ERROR}');
	$TSunic->redirect('back', 2);
	return false;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEDIRECTORY__SUCCESS}');
    $TSunic->redirect('$$$showIndex', array('$$$id' => $fk_parent));
    return true;
}
?>
