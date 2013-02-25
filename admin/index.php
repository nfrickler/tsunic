<!-- | Index file of backend -->
<?php

/* developer settings - show all errors */
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* end developer settings */

// set constant
define('TS_INIT', true);

// add autoloader
spl_autoload_register(function ($class) {
    include __DIR__ . '/classes/' . $class . '.class.php';
});

// start session
session_start();

// set global values
global $Config;
global $TemplateEngine;
global $Database;
global $Log;

// get important objects
$Config = new ts_ConfigurationHandler();
$TemplateEngine = new ts_TemplateEngine();
$Database = new ts_Database();
$Log = new ts_Log($Config->get('loglevel'));

// get event
if (!isset($_GET['event'])) $_GET['event'] = 'showIndex';
$public_pages = array('showLogin', 'setLogin', 'showSetLogin');

// get language
if (isset($_GET['lang'])) $_SESSION['lang'] = $_GET['lang'];

// authentification
include_once 'functions/checkAuth.func.php';
if (!in_array($_GET['event'], $public_pages) AND !checkAuth()) die('Authentification error!');

// switch event
switch ($_GET['event']) {
    case 'showLogin':

	// has password been set already?
	if (!$Config->get('admin_password')) {
	    header('Location:?event=showSetLogin');
	    exit;
	}

	$TemplateEngine->setData('html', array('title' => 'SHOWLOGIN__TITLE'));
	$TemplateEngine->activate('showLogin');
	break;
    case 'doLogin':

	// has password been set already?
	if (!$Config->get('admin_password')) {
	    header('Location:?event=showSetLogin');
	    exit;
	}

	// redirect to showMain
	header('Location:?');
	exit;
    case 'doLogout':
	unset($_SESSION['admin_auth']);
	header('Location:?event=showLogin');
	exit;
    case 'showSetLogin':

	// has password been set already?
	if ($Config->get('admin_password') AND !$_SESSION['admin_auth']) {
	    header('Location:?event=showLogin');
	    exit;
	}

	$TemplateEngine->setData('html', array('title' => 'SHOWSETLOGIN__TITLE'));
	$TemplateEngine->activate('showSetLogin');
	break;
    case 'setLogin':
	// include function
	include_once 'functions/setLogin.func.php';
	setLogin();
	break;
    case 'showIndex':
	$TemplateEngine->setData('html', array('title' => 'SHOWINDEX__TITLE'));
	$TemplateEngine->activate('showIndex');
	break;
    case 'showSystemcheck':
	$TemplateEngine->setData('html', array('title' => 'SHOWSYSTEMCHECK__TITLE'));
	$TemplateEngine->activate('showSystemcheck');

	// update installation-progress
	if ($Config->get('installation') < 100) {
	    $Config->setArray('installation_progress', 'showSystemcheck', true);
	}
	break;
    case 'showConfig':
	$TemplateEngine->setData('html', array('title' => 'SHOWCONFIG__TITLE'));
	$TemplateEngine->activate('showConfig');
	break;
    case 'setConfig':
	include_once 'functions/setConfig.func.php';
	setConfig();
	header('Location:?event=showConfig');
	exit;
    case 'showTools':
	$TemplateEngine->setData('html', array('title' => 'SHOWTOOLS__TITLE'));
	$TemplateEngine->activate('showTools');
	break;
    case 'showInitDatabase':
	include_once 'functions/initDatabase.func.php';
	initDatabase();
	$TemplateEngine->setData('html', array('title' => 'SHOWINITDATABASE__TITLE'));
	$TemplateEngine->activate('showInitDatabase');
	break;
    case 'showResetAll':
	$TemplateEngine->setData('html', array('title' => 'SHOWRESETALL__TITLE'));
	$TemplateEngine->activate('showResetAll');
	break;
    case 'resetAll':
	include_once 'functions/resetAll.func.php';
	resetAll();
	header('Location:?');
	exit;
    case 'showModules':

	// init database?
	include_once 'functions/initDatabase.func.php';
	if (!initDatabase()) header('Location:?event=showInitDatabase');

	// start ModuleHandler
	global $ModuleHandler;
	$ModuleHandler = new ts_ModuleHandler();
	$Modules = $ModuleHandler->getModules();

	$TemplateEngine->setData('html', array('title' => 'SHOWMODULES__TITLE'));
	$TemplateEngine->activate('showModules');
	break;
    case 'setModules':

	// start ModuleHandler
	global $ModuleHandler;
	$ModuleHandler = new ts_ModuleHandler();

	include_once 'functions/setModules.func.php';
	if (setModules() AND isset($_POST['submit_build'])) {
	    include_once 'functions/parseAll.func.php';
	    parseAll();
	}
	header('Location:?event=showModules');
	exit;
    case 'parseAll':

	// start ModuleHandler
	global $ModuleHandler;
	$ModuleHandler = new ts_ModuleHandler();

	include_once 'functions/parseAll.func.php';
	parseAll();

	header('Location:?event=showModules');
	exit;
    case 'installModule':
	include_once 'functions/installModule.func.php';
	installModule();
	header('Location:?event=showModules');
	exit;
    case 'updateModule':
	include_once 'functions/updateModule.func.php';
	updateModule();
	header('Location:?event=showModules');
	exit;
    case 'uninstallModule':
	include_once 'functions/uninstallModule.func.php';
	uninstallModule();
	header('Location:?event=showModules');
	exit;
    case 'deleteModule':
	include_once 'functions/deleteModule.func.php';
	deleteModule();
	header('Location:?event=showModules');
	exit;
    case 'showStyles':

	// init database?
	include_once 'functions/initDatabase.func.php';
	if (!initDatabase()) header('Location:?event=showInitDatabase');

	// start StyleHandler
	global $StyleHandler;
	$StyleHandler = new ts_StyleHandler();
	$Styles = $StyleHandler->getStyles();

	$TemplateEngine->setData('html', array('title' => 'SHOWSTYLES__TITLE'));
	$TemplateEngine->activate('showStyles');
	break;
    case 'setStyles':

	// start StyleHandler
	global $StyleHandler;
	$StyleHandler = new ts_StyleHandler();

	include_once 'functions/setStyles.func.php';
	setStyles();
	header('Location:?event=showStyles');
	exit;
    case 'setDefaultStyle':
	include_once 'functions/setDefaultStyle.func.php';
	setDefaultStyle();
	header('Location:?event=showStyles');
	exit;
    case 'deleteStyle':
	include_once 'functions/deleteStyle.func.php';
	deleteStyle();
	header('Location:?event=showStyles');
	exit;
    default:
	$TemplateEngine->setData('html', array('title' => 'PAGENOTFOUND__TITLE'));
	$TemplateEngine->activate('pageNotFound');
	break;
}

// calculate installation-progress
if ($Config->get('installation') < 100) {
    $progress = $Config->get('installation_progress');
    if (!$progress) {
	$progress = array('setLogin' => false,
			  'showSystemcheck' => false,
			  'setConfig' => false,
			  'setStyles' => false,
			  'parseAll' => false
			  );

	// save progress-bar
	$Config->set('installation_progress', $progress);
    }
    $percent = 0;
    foreach ($progress as $index => $value) {
	if ($value) $percent++;
    }
    $percent = $percent/count($progress) * 100;
    $Config->set('installation', round($percent));
    if ($percent >= 100) $Config->delete('installation_progress');
}

// display output
$TemplateEngine->display();
?>
