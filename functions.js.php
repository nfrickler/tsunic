<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | special file
 * file:			functions.js.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		File to load javascript-code of current page
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

// return Javascript-header
header('Content-Type: text/javascript; charset=utf-8');

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// return JS-code
$code = $TSunic->Tmpl->getAllJavascript();
foreach ($code as $index => $value) {
	echo base64_decode($value);
}
?>
