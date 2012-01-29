<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/uninstallModule.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; uninstall module
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

function uninstallModule () {

	// get id__module
	$id__module = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
	if (empty($id__module)) return true;

	// get module-object
	include_once 'classes/ts_Module.class.php';
	$Module = new ts_Module($id__module);

	// uninstall
	if (!$Module->uninstallModule()) {
		// error
		$_SESSION['admin_error'] = 'ERROR__UNINSTALLMODULE';
		return false;
	}

	$_SESSION['admin_info'] = 'INFO__UNINSTALLMODULE';
	return true;
}
?>