<?php
/** header *********************************************************************
 * project:	TSunic 4.1 | special file
 * file:	index.php
 * author:	Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:	Copyright 2012 Nicolas Frinker
 * description:	File to run TSunic (index-file)
 * licence:	This program is free software: you can redistribute it and/or modify
 * 		it under the terms of the GNU Affero General Public License as
 * 		published by the Free Software Foundation, either version 3 of the
 * 		License, or (at your option) any later version.
 *
 * 		This program is distributed in the hope that it will be useful,
 * 		but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 		GNU Affero General Public License for more details.
 *
 * 		You should have received a copy of the GNU Affero General Public License
 * 		along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */


/* DEBUG ********************************/
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* DEBUG END ****************************/

// try to change ini
ini_set("register_globals", "0");

// check installation- and offline-status
$ts_configs = array();
if (file_exists('config.php')) include_once 'config.php';
if (!isset($ts_configs['installation']) OR $ts_configs['installation'] < 100) {
	// please finish installation first
	header('Location:admin/index.php');
	die('Please install first...');
} elseif (!isset($ts_configs['system_online']) OR $ts_configs['system_online'] == false) {
	// system offline -> rediect to offline-message
	header('Location:offline.php');
	die('System is offline...');
}

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// run TSunic (NO OUTPUT BEFORE THIS CODE!)
$TSunic->run();

// display output of TSunic
$TSunic->display();
?>
