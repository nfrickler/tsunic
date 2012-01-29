<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/userheader.tpl.php
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
<div id="$$$div__userheader">
	<?php if ($TSunic->CurrentUser->isGuest()) { ?>
	<p id="$$$div__userheader__topright">
		<?php $this->set('{USERHEADER__NOTLOGGEDIN}'); ?>
	</p>
	<?php } else { ?>
	<p id="$$$div__userheader__topright">
		<?php $this->set('{USERHEADER__LOGGEDINAS}', array('name' => $TSunic->CurrentUser->getInfo('name'))); ?>
		| <a href="<?php $this->setUrl('$usersystem$doLogout'); ?>">
			<?php $this->set('{USERHEADER__LOGOUT}'); ?>
		</a>
	</p>
	<img src="<?php $this->setImg('project', '$$$unknown_user_small.png'); ?>" id="$$$div__userheader__image" />
	<?php } ?>
</div>