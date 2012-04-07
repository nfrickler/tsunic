<!-- | -->
<?php

class $$$Config {

	/* setting-cache
	 * array
	 */
	private $settings;

	/* configuration
	 * array
	 */
	private $config;

	/* path of config-file
	 * string
	 */
	private $path_config = 'config.php';

	/* runtime-settings
	 * array
	 */
	private $runtime;

	/* name of session
	 * string
	 */
	private $session_key = '$$$Config';

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
	/* get config-data
	 * @param string/bool: name of config-data (true will return all config-data)
	 * 
	 * @return OBJECT
	 */
	public function getConfig ($name) {
		global $TSunic;
		// load config
		if (!isset($this->config) OR empty($this->config)) $this->loadConfig();
		// return config
		if (isset($this->config[$name])) return $this->config[$name];
		return false;
	}

	/* get setting
	 * @param string: module of setting
	 * @param string/bool: name of setting (true will return all settings of this module)
	 * 
	 * @return mix
	 */
	public function get ($module, $name) {
		global $TSunic;

		// check, if already in cache
		if (isset($this->settings[$module],
				  $this->settings[$module][$name])) {
			return $this->settings[$module][$name];
		}

		// try to get setting from database
		$sql_0 = "SELECT _value_ as value
				FROM #pref#system__settings
				WHERE module = '".mysql_real_escape_string($module)."'
					AND name = '".mysql_real_escape_string($name)."';";
		$result_0 = $TSunic->Db->doSelect($sql_0);

		// get setting
		if (count($result_0) > 0) {
			// save in cache
			$this->settings[$module][$name] = $result[0]['value'];
			// return value
			$this->settings[$module][$name];
		}

		return NULL;
	}

	/* insert/update setting in database
	 * @param string: module of setting
	 * @param string/bool: name of setting
	 * @param string/int/bool: value of setting
	 * +@param string: description of setting
	 * +@param bool: secureSetting-status
	 * 
	 * @return OBJECT
	 */
	public function set ($module, $name, $value, $description = false, $secureSetting = false) {
		global $TSunic;

		// check, if setting exist
		$old_value = $this->get($module, $name);

		// insert/update
		if (!$old_value) {

			// get secureSetting
			$sql_secureSetting = ($secureSetting === true) ? 1 : 0;

			// insert as new setting
			$sql_0 = "INSERT INTO #pref#system__settings
					SET module = '".mysql_real_escape_string($module)."',
						name = '".mysql_real_escape_string($name)."',
						_value_ = '".mysql_real_escape_string($value)."',
						description = '".mysql_real_escape_string($description).",
						secureSetting = '".$sql_secureSetting."';";
			$result_0 = $TSunic->Db->doInsert($sql_0);

			// check for errors
			if (!$result_0) return false;
		} else {

			// get secureSetting
			$sql_secureSetting = ($secureSetting === true)
				? "secureSetting = '1',"
				: "secureSetting = '0',";

			// get sql_description
			$sql_description = (empty($sql_description))
				? ""
				: "description = '".mysql_real_escape_string($description)."',";

			// insert as new setting
			$sql_0 = "UPDATE #pref#system__settings
					  SET ".$sql_description."
						  ".$sql_secureSetting."
						  _value_ = '".mysql_real_escape_string($value)."'
					  WHERE module = '".mysql_real_escape_string($module)."'
					  	  	AND name = '".mysql_real_escape_string($name)."';";
			$result_0 = $TSunic->Db->doInsert($sql_0);

			// check for errors
			if (!$result_0) return false;
		}

		return false;
	}

	/* delete setting in database
	 * @param string: module of setting
	 * @param string/bool: name of setting
	 *
	 * @return bool
	 */
	public function delete ($module, $name) {
		global $TSunic;

		// check, if setting exist
		if (!$this->get($module, $name)) return true;

		// delete setting in database
		$sql_0 = "DELETE FROM #pref#system__settings
				WHERE module = '".mysql_real_escape_string($module)."'
					AND name = '".mysql_real_escape_string($name)."';";
		$result = $TSunic->Db->doDelete($sql_0);

		// return
		if (!$result) return false;
		return true;
	}

	/* get runtime-setting
	 * @param string: name of setting
	 *
	 * @return mix
	 */
	public function getRuntime ($name) {
		global $TSunic;

		// onload vars from session
		$this->loadRuntime();

		// check, if runtime-setting exist
		if (isset($this->runtime[$name])) return $this->runtime[$name];

		// runtime-setting does not exist
		return NULL;
	}

	/* set/update runtime-setting
	 * @param string: name of setting
	 * @param string: value of setting
	 *
	 * @return OBJECT
	 */
	public function setRuntime ($name, $value) {
		global $TSunic;

		// onload vars from session
		$this->loadRuntime();

		// set
		$this->runtime[$name] = $value;

		// save runtime in session
		$_SESSION[$this->session_key] = $this->runtime;
		return true;
	}

	/* load runtime-setting from session
	 *
	 * @return OBJECT
	 */
	public function loadRuntime () {
		global $TSunic;

		// check, if runtime already exist
		if (isset($this->runtime) AND !empty($this->runtime)) return true;

		// onload from session
		if (isset($_SESSION[$this->session_key])) {
			$this->runtime = $_SESSION[$this->session_key];
			return true;
		}

		// set empty runtime
		$this->runtime = array();

		return true;
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
