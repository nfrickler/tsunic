<!-- | Class to handle configuration -->
<?php
class ts_ConfigurationHandler {

    /* content of config-file
     * array
     */
    private $content;

    /* current version of TSunic
     * string
     */
    private $current_version = '4.4';

    /* constructor
     */
    public function __construct () {

	// read configuration-file
	$this->readConfig();

	return;
    }

    /* get configuration from file
     * +@param bool: force refresh of data
     *
     * @return bool
     */
    private function readConfig ($refresh = false) {

	// refresh?
	if (!empty($this->content) AND !$refresh) return true;

	// is file?
	if (!file_exists($this->getPath())) return false;

	// get configuration from file
	include $this->getPath();
	$this->content = $ts_configs;

	return true;
    }

    /* get configuration from file
     *
     * @return bool
     */
    public function get ($name) {

	// try to get value
	if (isset($this->content[$name])) return $this->content[$name];

	// get possible root dir
	$root = dirname($_SERVER['SCRIPT_FILENAME']);
	$root = substr($root, 0, (strlen($root) - strlen('admin/')));

	// get defaults
	switch ($name) {
	    case 'version':
		return $this->current_version;
	    case 'dir_admin':
		return $root.'/admin';
	    case 'dir_data':
		return $root.'/data';
	    case 'dir_runtime':
		return $root.'';
	    case 'root_folder':
		return '';
	    case 'data_folder':
		return 'data';
	    case 'loglevel':
		return 3;
	    case 'debug_mode':
		return true;
	    case 'email_enabled':
		return false;
	    case 'db_class':
		return 'mysql';
	    case 'db_host':
		return 'localhost';
	    case 'system_online':
		return true;
	    case 'allow_registration':
		return true;
	    case 'prefix':
		return 'ts_';
	    case 'encryption_class':
		return 'mcrypt';
	    case 'encryption_algorithm':
		return 'blowfish';
	    case 'encryption_mode':
		return 'ecb';
	    case 'system_secret':
		include_once 'functions/getRandomString.func.php';
		return getRandomString(20);
	}

	return NULL;
    }

    /* get path of config file
     *
     * @return bool
     */
    public function getPath () {
	return $this->get('dir_data').'/config.php';
    }

    /* delete configuration
     * @param string: name of setting to delete
     *
     * @return bool
     */
    public function delete ($name) {

	// delete and save
	if (isset($this->content[$name])) {
	    unset($this->content[$name]);
	    $this->saveConfig();
	}

	return true;
    }

    /* set configuration values
     * @param string: name of value
     * @param string: value to be set
     *
     * @return bool
     */
    public function set ($name, $value) {

	// validate input
	if (empty($name)) return false;

	// save in configuration
	$this->content[trim($name)] = $value;

	// save configuration in file
	$this->saveConfig();

	return true;
    }

    /* set single array-element
     * @param string: name of value
     * @param string: key of array-element
     * @param string: value to be set
     *
     * @return bool
     */
    public function setArray ($name, $key, $value) {

	// validate input
	if (empty($name) OR (!is_numeric($key) AND empty($key))) return false;

	// save in configuration
	if (!isset($this->content[trim($name)])) $this->content[trim($name)] = array();
	$this->content[trim($name)][trim($key)] = $value;

	// save configuration in file
	$this->saveConfig();

	return true;
    }

    /* set configuration in file
     *
     * @return bool
     */
    private function saveConfig () {

	// set current_version
	$this->content['version'] = $this->current_version;

	// create output
	$content = '<?php'.chr(10);
	$content.= '/* This file has been created automatically by TS_Admin */'.chr(10);
	$content.= '$ts_configs = array('.chr(10);
	foreach ($this->content as $index => $value) {

	    // handle arrays
	    if (is_array($value)) {

		$cache = '';
		foreach ($value as $in => $val) {
		    if ($val === true OR $val === 'true') {
			$cache.= ',"'.$in.'" => true';
		    } elseif ($val === false OR $val === 'false') {
			$cache.= ',"'.$in.'" => false';
		    } elseif (is_numeric($val)) {
			$cache.= ',"'.$in.'" => '.$val;
		    } else {
			$cache.= ',"'.$in.'" => "'.$val.'"';
		    }
		}

		$content.= '    "'.$index.'" => array('.substr($cache, 1).'),'.chr(10);
		continue;
	    }

	    // add to output
	    $content.= '    "'.$index.'" => ';
	    if ($value === true OR $value === 'true') {
		$content.= 'true';
	    } elseif ($value === false OR $value === 'false') {
		$content.= 'false';
	    } elseif (is_numeric($value)) {
		$content.= $value;
	    } else {
		$content.= '"'.$value.'"';
	    }
	    $content.= ','.chr(10);
	}
	$content = substr($content, 0, (strlen($content) - 2)).chr(10);
	$content.= '); ?>'; ?><?php

	// write output in file
	$file = @fopen($this->getPath(), 'w');
	if (!$file) {
	    echo 'Config-file "config.php" couldn\'t be written to!';
	    exit;
	}
	fwrite($file, $content);
	@fclose($file);

	// update config
	$this->readConfig(true);

	return true;
    }
}
?>
