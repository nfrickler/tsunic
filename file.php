<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | special file
 * file:			file.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		File to handle/load private images
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

// include TSunic.class
include_once 'runtime/classes/TSunic.class.php';

// start TSunic
$TSunic = new TSunic();

// get requested id
$id = (isset($_GET['id'])) ? $_GET['id'] : false;
if (empty($id) OR !is_numeric($id)) die('Access denied!');

// get Userfile-object
$Userfile = $TSunic->getUserfile($id);
if (!$Userfile->isValid()) die('Access denied!');

// is download?
$download = (isset($_GET['download']) AND $_GET['download'] == 'true') ? true : false;

// check, if download
if ($download) {

	// send download-headers
     header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header('Content-Disposition: attachment; filename='.$Userfile->getInfo('name'));
     header("Content-Transfer-Encoding: binary");
  //   header("Content-Length: ".filesize($path));
}

// send mime-type in header
if ($Userfile->getMimeType()) header('Content-Type: '.$Userfile->getMimeType());

// include file
$Userfile->includeFile();
?>
