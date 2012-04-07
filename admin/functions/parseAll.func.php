<!-- | function to parse TSunic -->
<?php
function parseAll () {
	global $Database, $Config, $ModuleHandler;

	// allow only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// load classes
	include_once 'classes/ts_FileHandler.class.php';
	include_once 'classes/ts_FormatHandler.class.php';
	include_once 'classes/ts_SubcodeHandler.class.php';
	include_once 'classes/ts_Parser.class.php';
	include_once 'classes/ts_LanguageHandler.class.php';
	include_once 'classes/ts_BackupHandler.class.php';
	include_once 'classes/ts_Module.class.php';

	// set global Objects
	global $FormatHandler, $SubcodeHandler, $Parser, $LanguageHandler;

	// is first call or a consecutive one?
	if (isset($_SESSION['parseAll__call']) AND !empty($_SESSION['parseAll__call'])) {
		// is consecutive call
		$call_num = $_SESSION['parseAll__call']['num'];
		$LanguageHandler = $_SESSION['parseAll__call']['LanguageHandler'];
		$FormatHandler = $_SESSION['parseAll__call']['FormatHandler'];
		$SubcodeHandler = $_SESSION['parseAll__call']['SubcodeHandler'];
		$Parser = $_SESSION['parseAll__call']['Parser'];
		$modules_all = $_SESSION['parseAll__call']['modules_all'];
		$pre_system_online = $_SESSION['parseAll__call']['pre_system_online'];
	} else {
		// is first call
		$call_num = 0;
		$FormatHandler = new ts_FormatHandler();
		$SubcodeHandler = new ts_SubcodeHandler();
		$modules_all = $ModuleHandler->getModules(true);
		$Parser = new ts_Parser($Config->get('preffix'), $modules_all, $Config->get('debug_mode'));
		$LanguageHandler = new ts_LanguageHandler();
		$pre_system_online = false;
	}

	if ($call_num == 0) {
		// set system as offline
		$pre_system_online = $Config->get('system_online');
		$Config->set('system_online', false);
		$Config->set('system_offline_since', date('m/d/y H:i:s'));

		// backup current runtime
		if (!ts_BackupHandler::backupRuntime(true)) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (backup folder "runtime")';
			return false;
		}

		// delete current code and files
		if (!ts_FileHandler::emptyFolder('../runtime')) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (delete folder "runtime")';
			return false;
		}
		if (!ts_FileHandler::emptyFolder('../files/project')) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (delete folder "files/project")';
			return false;
		}

		// recreate main-folders
		if (!(ts_FileHandler::createFolder('../files/project')
				AND ts_FileHandler::createFolder('../runtime/classes')
				AND ts_FileHandler::createFolder('../runtime/functions')
				AND ts_FileHandler::createFolder('../runtime/javascript')
				AND ts_FileHandler::createFolder('../runtime/templates')
				AND ts_FileHandler::createFolder('../runtime/xmlResponses'))) {
			$_SESSION['admin_error'] = 'ERROR__RENDER ((re-)creating runtime-folders)';
			return false;
		}

	} elseif ($call_num > 0 AND $call_num <= count($modules_all)) {

		// render all activated modules
		$call_counter = 0;
		$counter = 0;
		foreach ($modules_all as $index => $Value) {
			$counter++;

			// skip those, already parsed
			if ($counter < $call_num) continue;

			// parse module
			if (!$Value->parse()) {
				$_SESSION['admin_error'] = 'ERROR__RENDER (module: '.$Value->getInfo('name').')';
				return false;
			}
			$call_counter++;

			// always parse 2 modules at a time
			if ($call_counter <= 1) {
				$call_num++;
				continue;
			}

			break;
		}

	} else {

		// render subcodes
		if (!$SubcodeHandler->parseAll()) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (subfunction-parsing)';
			return false;
		}

		// render all activated styles
		include_once 'classes/ts_StyleHandler.class.php';
		$StyleHandler = new ts_StyleHandler();
		$styles_all = $StyleHandler->getStyles(true);
		foreach ($styles_all as $index => $Value) {
			if (!$Value->parse()) {
				$_SESSION['admin_error'] = 'ERROR__RENDER (style: '.$Value->getInfo('name').')';
				return false;
			}
		}
	
		// make sure, a default-style is chosen
		$StyleHandler->validateDefault();
	
		// get format.css
		if (($format = $FormatHandler->writeFiles() === false)) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (format.css)';
			return false;
		}
	
		// render language-files
		if (!$LanguageHandler->writeFiles()) {
			$_SESSION['admin_error'] = 'ERROR__RENDER (language-files)';
			return false;
		}
	
		// reset system_online
		$Config->set('system_online', $pre_system_online);
	
		// update installation-progress
		if ($Config->get('installation') < 100) {
			$Config->setArray('installation_progress', 'parseAll', true);
		}

		$_SESSION['admin_info'] = 'INFO__RENDER_SUCCESS';
	}

	// update call-progress
	if ($call_num > (count($modules_all)+2)) {
		// finished
		unset($_SESSION['parseAll__call']);
	} else {
		// save vars
		if (!isset($_SESSION['parseAll__call']) OR empty($_SESSION['parseAll__call']))
			$_SESSION['parseAll__call'] = array();
		$_SESSION['parseAll__call']['num'] = $call_num + 1;
		$_SESSION['parseAll__call']['LanguageHandler'] = $LanguageHandler;
		$_SESSION['parseAll__call']['FormatHandler'] = $FormatHandler;
		$_SESSION['parseAll__call']['SubcodeHandler'] = $SubcodeHandler;
		$_SESSION['parseAll__call']['Parser'] = $Parser;
		$_SESSION['parseAll__call']['modules_all'] = $modules_all;
		$_SESSION['parseAll__call']['pre_system_online'] = $pre_system_online;

		// redirect to next
		header('Location:?event=parseAll&call='.$call_num);
		exit;
	}

	return true;
}
?>
