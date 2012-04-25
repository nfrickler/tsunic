<!-- | FUNCTION set user access -->
<?php
function $$$setAccess () {
	global $TSunic;

	// get object to set access for
	$id = $TSunic->Temp->getParameter('$$$id');
	$isuser = $TSunic->Temp->getParameter('$$$isuser');
	if (!$id) {
		$TSunic->Log->add('error', '{SETACCESS__ERROR}', 3);
		$TSunic->redirect('back');
		return false;
	}

	// get Object
	$Object = $isuser ? $TSunic->get('$$$User', $id)->getAccess()
		: $TSunic->get('$$$Accessgroup', $id);

	// get input
	$all_posts = $TSunic->Temp->getPost(true);
	$error = 0;
	foreach ($all_posts as $index => $value) {
		$index = substr($index, strlen('$$$'));
		if ($value === "") $value = NULL;

		// is access?
		if (substr($index,0,12) != 'showAccess__') continue;

		// set access
		$access = substr($index, 12);
		if (!$Object->set($access, $value)) {
			$error = 1;
			$TSunic->Log->add('error', '{SETACCESS__ERROR}', 3);
		}
	}

	// success
	if (!$error) {
		$TSunic->Log->add('info', '{SETACCESS__SUCCESS}', 3);
		$TSunic->redirect('back');
		return true;
	}

	// return error
	$TSunic->redirect('back');
	return false;
}
?>
