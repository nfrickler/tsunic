<!-- | FUNCTION set user config -->
<?php
function $$$setConfig () {
	global $TSunic;

	// get UserConfig
	$id = $TSunic->Temp->getParameter('$$$showConfig__id');
	$User = ($id) ? $TSunic->get('$$$User', $id) : $TSunic->Usr;
	$UserConfig = $User->getConfig();

	// get input
	$all_posts = $TSunic->Temp->getPost(true);
	$error = 0;
	foreach ($all_posts as $index => $value) {
		$index = substr($index, strlen('$$$'));

		// is config?
		if (substr($index,0,12) != 'showConfig__') continue;
		$config = substr($index, 12);
		if ($config == "id") continue;

		// set config value
		if (!$UserConfig->set($config, $value)) {
			$error = 1;
			$TSunic->Log->alert('error', '{SETCONFIG__ERROR}');
		}
	}

	// success
	if (!$error) {
		$TSunic->Log->alert('info', '{SETCONFIG__SUCCESS}');
		$TSunic->redirect('$$$showConfig', array('$$$id' => $User->getInfo('id')));
		return true;
	}

	// return error
	$TSunic->redirect('back');
	return false;
}
?>
