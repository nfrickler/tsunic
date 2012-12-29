<!-- | FUNCTION delete selection -->
<?php
function $$$deleteSelection () {
    global $TSunic;

    // get Selection object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Selection = $TSunic->get('$$$Selection', $id);

    // delete selection
    if (!$Selection->delete()) {
	$TSunic->Log->alert('error', '{DELETESELECTION__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETESELECTION__SUCCESS}');
    $TSunic->redirect('$$$showTags');

    return true;
}
?>
