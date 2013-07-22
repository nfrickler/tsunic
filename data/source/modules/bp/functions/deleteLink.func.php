<!-- | FUNCTION delete Link -->
<?php
function $$$deleteLink () {
    global $TSunic;

    // get Link object
    $id = $TSunic->Input->uint('$$$id');
    $Link = $TSunic->get('$$$Link', $id);

    // delete Link
    if (!$Link->delete()) {
	$TSunic->Log->alert('error', '{DELETELINK__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETELINK__SUCCESS}');
    $TSunic->redirect('back');

    return true;
}
?>
