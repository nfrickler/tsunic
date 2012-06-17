<!-- p | Run this file to prepare backend for publishing -->
<?php
/* NOTE
 * Do not run this script more than once or all headers will be lost again!
 */

/* developer settings - show all errors */
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* end developer settings */

// set constant
define('TS_INIT', true);

// add autoloader
function __autoload ($class_name) {
    include_once 'classes/'.$class_name.'.class.php';
}

// start session
session_start();

// include classes
include_once 'classes/ts_ConfigurationHandler.class.php';
include_once 'classes/ts_FileHandler.class.php';
include_once 'classes/ts_Log.class.php';
include_once "classes/ts_PreParser.class.php";

// set global values
global $Config;
global $Log;

// create global objects
$Config = new ts_ConfigurationHandler();
$Log = new ts_Log($Config->get('loglevel'));

// create other objects
$DummyPacket = new ts_DummyPacket();
$PreParser = new ts_PreParser($DummyPacket);


// preparse all backend files
$path = $Config->getRoot(false)."/admin";
if ($PreParser->parse($path, $path, $Config->getRoot(false), true)) {
    echo "Backend ready.<br />\n";
} else {
    echo "ERROR: Could not preparse backend!<br />\n";
}


// preparse special files
$special_files = array(
    'index.php',
    'file.php',
    'offline.php',
    'functions.js.php',
    'ajax.php'
);
foreach ($special_files as $index => $file) {
    if ($PreParser->parseFile(
	$Config->getRoot(false)."/".$file,
	$Config->getRoot(false)."/".$file,
	$Config->getRoot(false),
	true
    )) {
	echo "Preparsed special file $file<br />\n";
    } else {
	echo "ERROR: Could not preparse special file $file<br />\n";
    }
}

echo "Done...\n";

class ts_DummyPacket {

    /* array to cache version.xml
     * array
     */
    private $infofile = array();

    /* get info from version.xml file
     * @param string: name of info
     *
     * @return mix
     */
    public function getInfo ($name) {

	// check, if requested info is already in $this->info
	if (isset($this->infofile, $this->infofile[$name]) AND !empty($this->infofile[$name])) return $this->infofile[$name];

	// load from version-file
	if (!file_exists('version.xml')) return NULL;
	include_once 'classes/ts_XmlHandler.class.php';
	$this->infofile = ts_XmlHandler::readAll('version.xml');

	// try again to return requested info
	if (isset($this->infofile, $this->infofile[$name])) return $this->infofile[$name];
	return NULL;
    }
}
?>
