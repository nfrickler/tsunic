<?php
/* This file initializes TSunic
 * Include this where you want to use TSunic
 */

/* DEBUG ********************************/
error_reporting(E_ALL);
#ini_set('display_errors', 1);
/* DEBUG END ****************************/

// set autoloader
spl_autoload_register(function ($class) {
    include __DIR__ . '/classes/' . $class . '.class.php';
});

// load config
$ts_configs = array();
include __DIR__ . '/config.php';

// is on/offline?
if (!isset($ts_configs['installation']) OR $ts_configs['installation'] < 100) {
    // installation incomplete
    die('Please install first...');
} elseif (!isset($ts_configs['system_online']) OR $ts_configs['system_online'] == false) {
    // system offline
    header('Location:offline.php');
    die('System is offline...');
}

// start TSunic
$TSunic = new TSunic();
?>
