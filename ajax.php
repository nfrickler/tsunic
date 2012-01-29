<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | special file
 * file:			ajax.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		File to handle ajax-requests 
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

// set XML-header
header("Content-type: text/xml");

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// run TSunic
$TSunic->run();

// return XML-response
echo '<?xml version="1.0" encoding="utf-8" ?>';
$TSunic->display();
?>
