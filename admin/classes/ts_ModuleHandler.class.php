<!-- | class to handle modules -->
<?php
class ts_ModuleHandler {

    /* module-objects of all existing modules
     * array
     */
    private $modules;

    /* constructor
     */
    public function __construct () {

	return;
    }

    /* validate source-code
     * @param bool: force to get new list from database (not a cached one from obj-var)
     *
     * @return array
     */
    public function getModules ($force_update = false) {
	global $Database, $Config;

	// already in obj-var?
	if (!$force_update AND isset($this->modules) AND !empty($this->modules)) return $this->modules;

	// get module-ids from database
	$sql = "SELECT id__module as id__module
		FROM #__modules
		ORDER BY name ASC;";
	$result = $Database->doSelect($sql);
	if ($result === false) return false;

	// get available sources
	$subfolders = ts_FileHandler::getSubfolders($Config->get('dir_data').'/source/modules/');
	if (!is_array($subfolders)) return false;

	// get module-objects and save them in obj-var
	$modules_files = array();
	foreach ($subfolders as $index => $value) {
	    $modules_files[] = new ts_Module(false, $value);
	}

	// add already deleted modules and rearrange
	$this->modules = array();
	foreach ($modules_files as $index => $Value) {
	    $this->modules[$Value->getInfo('name').'__'.$Value->getInfo('nameid')] = $Value;
	}
	foreach ($result as $index => $values) {
	    $Module = new ts_Module($values['id__module']);
	    if (!isset($this->modules[$Module->getInfo('name').'__'.$Module->getInfo('nameid')])) {
		$this->modules[$Module->getInfo('name').'__'.$Module->getInfo('nameid')] = $Module;
	    }
	}

	// sort
	ksort($this->modules);

	return $this->modules;
    }
}
