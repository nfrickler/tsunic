<!-- | FUNCTION add user to accessgroup -->
<?php
function $$$addAccessgroupmember () {
    global $TSunic;

    // get input
    $id = $TSunic->Input->uint('$$$showAddAccessgroupmember__id');
    $fk_account = $TSunic->Input->uint('$$$showAddAccessgroupmember__user');

    // create accessgroup object
    $Accessgroup = $TSunic->get('$$$Accessgroup', $id);

    // add user to accessgroup
    $return = $Accessgroup->addMember($fk_account);

    // check, if create successful
    if ($return) {
	// success
	$TSunic->Log->alert('info', '{ADDACCESSGROUPMEMBER__SUCCESS}');
	$TSunic->redirect('$$$showAccessgroupmembers', array('$$$id' => $Accessgroup->getInfo('id')));
	return true;
    }

    // add error-message and redirect back
    $TSunic->Log->alert('error', '{ADDACCESSGROUPMEMBER__ERROR}');
    $TSunic->redirect('back');
    return true;
}
?>
