<!-- | TEMPLATE - show header -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/header.tpl.php
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
?>
<div id="$$$div__header">
	<div id="$$$div__header__logodiv">
		<img src="<?php $this->setImg('project', '$$$tsunic4_logo.png'); ?>" alt="logo TSunic 4.0" style="height:80px; margin-top:2px; float:left; margin-right:10px;" />
		<h1 style="padding-top:10px; padding-left:10px;"><?php $this->set('TSunic '.$TSunic->Config->getConfig('version')); ?></h1>
		<p style="padding-left:10px;"><?php echo $this->set('Manage your life - the easy way!'); ?></p>
		<div style="clear:both;"></div>
	</div>
	<?php $this->display('$usersystem$userheader'); ?>
</div>