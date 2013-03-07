<!-- | FUNCTION delete issue -->
<?php
function $$$deleteIssue () {
    global $TSunic;

    // get Issue object
    $id = $TSunic->Temp->getParameter('$$$id');
    $Issue = $TSunic->get('$$$Issue', $id);

    // delete issue
    if (!$Issue->delete()) {
	$TSunic->Log->alert('error', '{DELETEISSUE__ERROR}');
	$TSunic->redirect('back');
	return true;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEISSUE__SUCCESS}');
    $TSunic->redirect('$$$showIndex');

    return true;
}
?>
