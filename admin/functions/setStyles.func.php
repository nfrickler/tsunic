<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | TS_ADMIN
 * file:			admin/functions/setStyles.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		Function; activate/deactivate styles
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

function setStyles () {
	global $Database;
	global $Config;

	// get styleHandler-object
	include_once 'classes/ts_StyleHandler.class.php';
	$StyleHandler = new ts_StyleHandler();

	// allow only, if logged in
	if (!isset($_SESSION['admin_auth']) OR empty($_SESSION['admin_auth']))
		return false;

	// get input
	$styles_activated = array();
	foreach ($_POST as $index => $value) {
		if (substr($index, 0, 7) != 'style__') continue;
		$styles_activated[] = substr($index, 7);
	}

	// get objects of all styles
	$styles_all = $StyleHandler->getStyles();

	// activate or deactivate modules
	foreach ($styles_all as $index => $Value) {
		$new_status = (in_array($Value->getInfo('id__style'), $styles_activated)) ? true : false;
		if (!$Value->activate($new_status)) return false;
	}

	// update installation-progress
	if ($Config->get('installation') < 100) {
		$Config->setArray('installation_progress', 'setStyles', true);
	}

	$_SESSION['admin_info'] = 'INFO__SETSTYLES_SUCCESS';
	return true;
}
?>