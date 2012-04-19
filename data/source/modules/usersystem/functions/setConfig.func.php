<!-- | FUNCTION set user config -->
<?php
function $$$setConfig () {
	global $TSunic;

	// get UserConfig
	$UserConfig = $TSunic->Usr->getConfig();

	// get input
	$all_posts = $TSunic->Temp->getPost(true);
	$error = 0;
	foreach ($all_posts as $index => $value) {
		$index = substr($index, strlen('$$$'));

		// is config?
		if (substr($index,0,12) != 'showConfig__') continue;

		// set config value
		$config = substr($index, 12);
		if (!$UserConfig->set($config, $value)) {
			$error = 1;
			$TSunic->Log->add('error', '{SETCONFIG__ERROR}', 3);
		}
	}

	// success
	if (!$error) {
		$TSunic->Log->add('info', '{SETCONFIG__SUCCESS}', 3);
		$TSunic->redirect('$$$showConfig');
		return true;
	}

	// return error
	$TSunic->redirect('back');
	return false;
}
?>
