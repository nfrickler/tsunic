<!-- | FUNCTION set user access -->
<?php
function $$$setAccess () {
    global $TSunic;

    // get object to set access for
    $id = $TSunic->Input->uint('$$$id');
    $isuser = $TSunic->Input->param('$$$isuser');
    if (!$id) {
	$TSunic->Log->alert('error', '{SETACCESS__ERROR}');
	$TSunic->redirect('back');
	return false;
    }

    // get Object
    $Object = $isuser ? $TSunic->get('$$$User', $id)->getAccess()
	: $TSunic->get('$$$Accessgroup', $id);

    // get input
    $all_posts = $TSunic->Input->post(true);
    $error = 0;
    foreach ($all_posts as $index => $value) {
	$index = substr($index, strlen('$$$'));
	if ($value === "") $value = NULL;

	// is access?
	if (substr($index,0,12) != 'showAccess__') continue;

	// set access
	$access = substr($index, 12);
	if (!$Object->setAccess($access, $value)) {
	    $error = 1;
	    $TSunic->Log->alert('error', '{SETACCESS__ERROR}');
	}
    }

    // success
    if (!$error) {
	$TSunic->Log->alert('info', '{SETACCESS__SUCCESS}');
	$TSunic->redirect('back');
	return true;
    }

    // return error
    $TSunic->redirect('back');
    return false;
}
?>
