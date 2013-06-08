<!-- | FUNCTION delete tag -->
<?php
function $$$deleteTag () {
    global $TSunic;

    // get Tag object
    $id = $TSunic->Input->uint('$$$id');
    $Tag = $TSunic->get('$$$Tag', $id);

    // delete tag
    if (!$Tag->delete()) {
	$TSunic->Log->alert('error', '{DELETETAG__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETETAG__SUCCESS}');
    $TSunic->redirect('$$$showTags');

    return true;
}
?>
