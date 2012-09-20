<!-- | handle requests -->
<?php
/* DEBUG ********************************/
error_reporting(E_ALL);
#ini_set('display_errors', 1);
/* DEBUG END ****************************/

// check installation- and offline-status
$ts_configs = array();
if (file_exists('config.php')) include_once 'config.php';
if (!isset($ts_configs['installation']) OR $ts_configs['installation'] < 100) {
    // please finish installation first
    header('Location:admin/index.php');
    die('Please install first...');
} elseif (!isset($ts_configs['system_online']) OR $ts_configs['system_online'] == false) {
    // system offline -> rediect to offline-message
    header('Location:offline.php');
    die('System is offline...');
}

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// run TSunic (NO OUTPUT BEFORE THIS CODE!)
$TSunic->run();

// display output of TSunic
$TSunic->display();
?>
