<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/initDatabase.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; initialize database
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

function initDatabase () {
	global $Database, $Config;

	// allow changes only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// is already initialized?
	if ($Database->isTable('#__modules') AND $Database->isTable('#__styles')) return true;

	// init database
	$path = 'data/install.sql';
	if ($Database->runFile($path) === false) {
		$_SESSION['admin_error'] = 'ERROR__INITDATABASE';
	} else {
		$_SESSION['admin_info'] = 'INFO__INITDATABASE';
	}

	return true;
}
?>