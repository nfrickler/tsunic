<?php
/** header *********************************************************************
 * project:			TSunic 4.1 | special file
 * file:			offline.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * description:		This file is accessed, when TSunic is currently offline
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

// try to include config.php
$path = 'config.php';
$ts_configs = array();
if (file_exists($path)) include_once $path;
?>
<h1>Dear User,</h1>
<p>
	We are sorry, but this system is currently offline.<br />
	We hope you will return later to get access to our site being online again...
</p>
<p>
	<a href="index.php">Try again now!</a>
</p>

<?php if (isset($ts_configs['system_offline_since'])) { ?>
<p>
	This system is offline since:
	<?php echo $ts_configs['system_offline_since']; ?>
</p>
<?php } ?>