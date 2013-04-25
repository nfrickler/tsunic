<!-- | CLASS Config -->
<?php
/** This class provides access to the values in the configuration file
 *
 * One object of this class is available at TSunic::Config
 */
class $$$Config {

    /** Internal cache for configuration settings
     * @var array $config
     */
    private $config;

    /** Path to configuration file
     * @var string $path_config
     */
    private $path_config = 'config.php';

    /** Load configuration from file
     *
     * If this method failes to read the configuration from the specified
     * file, it will throw a fatale error
     *
     * @return bool
     */
    protected function loadConfig () {
	global $TSunic;

	// load settings from config file
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

    /** Get configuration value
     * @param string $name
     *	Name of configuration
     *
     * @return mix
     */
    public function get ($name) {
	global $TSunic;

	// load config
	if (!isset($this->config) OR empty($this->config)) $this->loadConfig();

	// return config
	if (isset($this->config[$name])) return $this->config[$name];

	return NULL;
    }
}
?>
