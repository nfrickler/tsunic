<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/showIndex.tpl.php
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
<div id="$$$div__showIndex">
	<h1><?php echo $this->set('{SHOWINDEX__H1}'); ?></h1>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__INFOTEXT}'); ?></p>
	<h2><?php echo $this->set('{SHOWINDEX__LOGIN_H1}'); ?></h2>
	<?php $this->display('$$$formLogin'); ?>
	<h2><?php echo $this->set('{SHOWINDEX__REGISTER_H1}'); ?></h2>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__REGISTER_INFOTEXT}'); ?></p>
	<?php $this->display('$$$formRegistration'); ?>
	<h2><?php echo $this->set('{SHOWINDEX__RESET_H1}'); ?></h2>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__RESET_INFOTEXT}'); ?></p>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$system$resetAllCookies'); ?>">
			<?php echo $this->set('{SHOWINDEX__REGISTER_LINK}'); ?></a>
	</p>
</div>