<!-- | FUNCTION delete member from accessgroup -->
<?php
function $$$deleteAccessgroupmember () {
    global $TSunic;

    // get accessgroup
    $id = $TSunic->Input->uint('$$$id');
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);
    $userid = $TSunic->Input->uint('$$$userid');

    // delete accessgroup
    if (!$Accessgroup->rmMember($userid)) {
	$TSunic->Log->alert('error', '{DELETEACCESSGROUPMEMBER__ERROR}');
	$TSunic->redirect('back', 2);
	return false;
    }

    // success
    $TSunic->Log->alert('info', '{DELETEACCESSGROUPMEMBER__SUCCESS}');
    $TSunic->redirect('$$$showAccessgroupmembers', array('$$$id' => $id));
    return true;
}
?>
