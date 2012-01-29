<!-- | function to show index-page (default startup-page) -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			functions/showSysteminfo.func.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
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

function $$$showSysteminfo () {
	global $TSunic;

	// get infos about modules
	$sql_0 = "SELECT *
				FROM ".$TSunic->Config->getConfig('preffix')."modules
				WHERE is_activated = 1
					AND is_parsed = 1
				ORDER BY name ASC;";
	$result_0 = $TSunic->Db->doSelect($sql_0);

	// activate template
	$data = array('modules' => $result_0);
	$TSunic->Tmpl->activate('$$$showSysteminfo', '$$$content', $data);
	$TSunic->Tmpl->activate('$$$html', false, array('title' => '{SYSTEMINFO__TITLE}'));

	return true;
}
?>