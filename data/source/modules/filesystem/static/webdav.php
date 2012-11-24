<?php
// include autoload
require_once 'static/SabreDAV/vendor/autoload.php';

// init TSunic
include_once 'init.php';

// Authentication
$auth = new Sabre_HTTP_BasicAuth();
$result = $auth->getUserPass();

if (!$result OR !$TSunic->Usr->login($result[0], $result[1])) {
    $auth->requireLogin();
    echo "Authentication required\n";
    die();
}

// Get root directory object
$rootDirectory = new $$$DavCollection();

// get server object
$server = new Sabre_DAV_Server($rootDirectory);

// set base uri
//$server->setBaseUri('webdav.php');

// Add lock plugin
$lockBackend = new Sabre_DAV_Locks_Backend_File($TSunic->Config->get('dir_data').'/webdavlocks');
$lockPlugin = new Sabre_DAV_Locks_Plugin($lockBackend);
$server->addPlugin($lockPlugin);

// We assume $server is a Sabre_DAV_Server

// You may enable this webserver for debugging purposes...
//$plugin = new Sabre_DAV_Browser_Plugin();
//$server->addPlugin($plugin);

// All we need to do now, is to fire up the server
$server->exec();
?>
