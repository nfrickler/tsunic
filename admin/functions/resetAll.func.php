<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/resetAll.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; reset software
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

function resetAll () {
	global $Database;
	global $Config;

	// allow changes only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// uninstall all modules
	// TODO

	// delete all runtime- and user-files
	// TODO

	// delete main tables
	$sql_0 = "DROP TABLE IF EXISTS #__modules, #__languages;";
	$result_0 = $Database->doDelete($sql_0);
	if (!$result_0) return false;

	// reset installation-progress
	$Config->delete('installation_progress');

	$_SESSION['admin_info'] = 'INFO__ALLRESET_SUCCESS';
	return true;
}
?>