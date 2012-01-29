<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/deleteStyle.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; delete style
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

function deleteStyle () {

	// get id__style
	$id__style = (isset($_GET['id']) AND is_numeric($_GET['id'])) ? $_GET['id'] : 0;
	if (empty($id__style)) return true;

	// get style-object
	include_once 'classes/ts_Style.class.php';
	$Style = new ts_Style($id__style);

	// delete
	if (!$Style->deleteStyle()) {
		// error
		$_SESSION['admin_error'] = 'ERROR__DELETESTYLE';
		return false;
	}

	$_SESSION['admin_info'] = 'INFO__DELETESTYLE';
	return true;
}
?>