<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/setConfig.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; set configuration
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

function setConfig () {
	global $Config;

	// allow changes only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// system online?
	$pre_online_status = $Config->get('system_online');

	// validate input and save in config-file
	foreach ($_POST as $index => $value) {

		// validate data
		if (!($value === false) AND empty($value)) continue;

		// is s.th. to save in config-file?
		if (!substr($index, 0, 5) == 'set__') continue;

		// get name of setting
		$name = substr($index, 5);

		// save in config-file
		$Config->set($name, $value);
	}

	// is system offline/online?
	if ($Config->get('system_online') == true) {
		$Config->delete('system_offline_since');
	} elseif ($pre_online_status == true) {
		$Config->set('system_offline_since', date('m/d/y H:i:s'));
	}

	// update installation-progress
	if ($Config->get('installation') < 100) {
		$Config->setArray('installation_progress', 'setConfig', true);
	}

	$_SESSION['admin_info'] = 'INFO__SAVED';
	return true;
}
?>