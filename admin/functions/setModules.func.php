<!-- | function to activate/deactivate  modules -->
<?php
function setModules () {
	global $Database;
	global $Config;
	global $ModuleHandler;

	// allow only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// get input
	$modules_activated = array();
	foreach ($_POST as $index => $value) {
		if (substr($index, 0, 8) != 'module__') continue;
		$modules_activated[] = substr($index, 8);
	}

	// get objects of all modules
	$modules_all = $ModuleHandler->getModules();

	// activate or deactivate modules
	foreach ($modules_all as $index => $Value) {
		$new_status = (in_array($Value->getInfo('id__module'), $modules_activated)) ? true : false;
		if (!$Value->activate($new_status)) return false;
	}

	// update installation-progress
	if ($Config->get('installation') < 100) {
		$Config->setArray('installation_progress', 'setModules', true);
	}

	$_SESSION['admin_info'] = 'INFO__SETMODULES_SUCCESS';
	return true;
}
?>
