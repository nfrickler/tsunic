<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/showLogin.tpl.php
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
<div id="$$$div__showLogin">
	<h1><?php echo $this->set('{SHOWLOGIN__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php echo $this->set('{SHOWLOGIN__INFOTEXT}'); ?>
	</p>
	<?php $this->display('$$$formLogin'); ?>
	<h2><?php echo $this->set('{SHOWLOGIN__RESET_H1}'); ?></h2>
	<p class="ts_infotext"><?php echo $this->set('{SHOWLOGIN__RESET_INFOTEXT}'); ?></p>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$system$resetAllCookies'); ?>">
			<?php echo $this->set('{SHOWLOGIN__RESET_LINK}'); ?></a>
	</p>
</div>