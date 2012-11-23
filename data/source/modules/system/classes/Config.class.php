<!-- | Configuration class -->
<?php
class $$$Config {

    /* configuration
     * array
     */
    private $config;

    /* path of config-file
     * string
     */
    private $path_config = 'config.php';

    /* constructor
     */
    public function __construct () {
	return;
    }

    /* load configuration
     *
     * @return bool OR REDIRECT
     */
    protected function loadConfig () {
	global $TSunic;

	// load settings from config.php
	if (file_exists($this->path_config)) {

	    // include config.php
	    include $this->path_config;

	    // check, if valid input
	    if (!is_array($ts_configs)) {
		// no configurations
		$TSunic->throwError('config.php is invalid!');
	    }
	    // save settings in object-var
	    $this->config = $ts_configs;
	} else {
	    // config.php doesn t exist - return error
	    $TSunic->throwError('config.php doesn\'t exist!');
	}
	return true;
    }

    /* get config-data (deprecated, use get instead)
     * @param string/bool: name of config-data (true will return all config-data)
     *
     * @return OBJECT
     */
    public function getConfig ($name) {
	return $this->get($name);
    }

    /* get config-data
     * @param string/bool: name of config-data (true will return all config-data)
     *
     * @return OBJECT
     */
    public function get ($name) {
	global $TSunic;
	// load config
	if (!isset($this->config) OR empty($this->config)) $this->loadConfig();
	// return config
	if (isset($this->config[$name])) return $this->config[$name];
	return false;
    }

    /* get root-path
     * +@param bool: get data-rootpath instead of "normal" root
     *
     * @return string
     */
    public function getRoot ($data_root = false) {

	// get root-path
	$root = $this->getConfig('root_folder');
	if (!$root) return '';
	if (!$data_root) return $root;

	// get data-root
	$root = $root.'/'.$this->getConfig('data_folder');
	if ($root) return $root;

	return '';
    }
}
?>
