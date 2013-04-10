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
	usort($this->modules, array($this, 'cb_sortByDependencies'));
	$this->modules = array_reverse($this->modules);

	return $this->modules;
    }

    /* get module by name
     * @param string: name of module
     *
     * @return object
     */
    public function getModule ($name) {
	foreach ($this->modules as $index => $Value) {
	    if ($Value->getInfo('name') == $name) return $Value;
	}
	return NULL;
    }

    /* get order of module A and module B concerning dependencies
     * @param object: module A
     * @param object: module B
     *
     * @return int
     */
    public function cb_sortByDependencies ($modA, $modB) {
	$nameA = $modA->getInfo('name');
	$nameB = $modB->getInfo('name');
	//var_dump("Compare: $nameA <=> $nameB");

	// Does modA depend on modB?
	if ($this->dependOn($modA, $modB)) {
	    return -1;
	}

	// Does modB depend on modA?
	if ($this->dependOn($modB, $modA)) {
	    return 1;
	}

	return 0;
    }

    /* does A depend on B?
     * @param object: module A
     * @param object: module B
     * +@param int: loop prevention (stop after 30 dependencies)
     *
     * @return bool
     */
    public function dependOn ($modA, $modB, $loop = 0) {
	$loop++;
	if ($loop >= 30) die(
	    "ModuleHandler: Dependency loop detected! Check dependencies!"
	);
	if (!$modA or !$modB) return false;

	// get name of B
	$nameB = $modB->getInfo('name');

	// get dependencies of A
	$deps = $modA->getInfo('dependencies');

	// A has no deps?
	if (empty($deps)) return false;

	// Check if B is within deps
	foreach ($deps as $index => $values) {
	    if ($values['value'] == $nameB) {
		return true;
	    }
	}

	// Check reverse if B is within deps of deps
	foreach ($deps as $index => $values) {
	    if ($this->dependOn($this->getModule($values['value']), $modB)) {
		return true;
	    }
	}

	return false;
    }
}
?>
