<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/setModules.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; activate/deactivate modules
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

// deny direct access
defined('TS_INIT') OR die('Access denied!');

function setModules () {
	global $Database;
	global $Config;
	global $ModuleHandler;

	// allow only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// get input
	$modules_activated = array();
	foreach ($_POST as $index => $value) {
		if (substr($index, 0, 8) != 'module__') continue;
		$modules_activated[] = substr($index, 8);
	}

	// get objects of all modules
	$modules_all = $ModuleHandler->getModules();

	// activate or deactivate modules
	foreach ($modules_all as $index => $Value) {
		$new_status = (in_array($Value->getInfo('id__module'), $modules_activated)) ? true : false;
		if (!$Value->activate($new_status)) return false;
	}

	// update installation-progress
	if ($Config->get('installation') < 100) {
		$Config->setArray('installation_progress', 'setModules', true);
	}

	$_SESSION['admin_info'] = 'INFO__SETMODULES_SUCCESS';
	return true;
}
?>
