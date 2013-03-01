<!-- | class to handle modules -->
<?php
class ts_ModuleHandler {

    /* module-objects of all existing modules
     * array
     */
    private $modules;

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
		ORDER BY id__module ASC;";
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

	// sort modules by dependencies
	// Serveral times required... Fix?
	usort($this->modules, array($this, 'cb_sortByDependencies'));
	usort($this->modules, array($this, 'cb_sortByDependencies'));

	// reverse order
	$this->modules = array_reverse($this->modules);

	return $this->modules;
    }

    /* validate source-code
     * @param bool: force to get new list from database (not a cached one from obj-var)
     *
     * @return int
     */
    public function cb_sortByDependencies ($modA, $modB) {
	if ($modA->getInfo('name') == $modB->getInfo('name')) return 0;

	// Does modA depend on modB?
	$deps = $modA->getInfo('dependencies');
	if ($deps and is_array($deps)) {
	    foreach ($deps as $index => $values) {
		if ($values['value'] == $modB->getInfo('name')) return -1;
	    }
	}

	// Does modB depend on modA?
	$deps = $modB->getInfo('dependencies');
	if ($deps and is_array($deps)) {
	    foreach ($deps as $index => $values) {
		if ($values['value'] == $modA->getInfo('name')) return 1;
	    }
	}

	return 1;
    }
}
?>
