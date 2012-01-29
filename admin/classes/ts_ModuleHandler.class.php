<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/classes/ts_ModuleHandler.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Class; handle modules
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class ts_ModuleHandler {

	/* module-objects of all existing modules
	 * array
	 */
	private $modules;	 

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		// load module-class
		include_once 'classes/ts_Module.class.php';

		return;
	}

	/* validate source-code
	 * @param bool $force_update: force to get new list from database (not a cached one from obj-var)
	 *
	 * @return array
	 */
	public function getModules ($force_update = false) {
		global $Database, $Config;

		// already in obj-var?
		if (!$force_update AND isset($this->modules) AND !empty($this->modules)) return $this->modules;

		// get module-ids from database
		$sql_0 = "SELECT id__module as id__module
					FROM #__modules
					ORDER BY name ASC;";
		$result_0 = $Database->doSelect($sql_0);
		if ($result_0 === false) return false;

		// get available sources
		include_once 'classes/ts_FileHandler.class.php';
		$subfolders = ts_FileHandler::getSubfolders($Config->getRoot(true).'/source/modules/');
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
		foreach ($result_0 as $index => $values) {
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
