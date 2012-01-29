<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/_system_navigation.tpl.php
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
<div id="$$$div___navigation">
	<ul>
	<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
		<li id="$$$_navigation__account">
			<a href="<?php $this->setUrl('$$$showAccount'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWACCOUNT}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__profile">
			<a href="<?php $this->setUrl('$$$showProfile'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWPROFILE}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__logout">
			<a href="<?php $this->setUrl('$$$doLogout'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TODOLOGOUT}'); ?>
			</a>
		</li>
	<?php } else { ?>
		<li id="$$$_navigation__showindex">
			<a href="<?php $this->setUrl('$$$showIndex'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWINDEX}'); ?>
			</a>
		</li>
	<?php } ?>
	</ul>
</div>
<script type="text/javascript">

	// add events
	<?php if ($TSunic->CurrentUser->isGuest() == false) { ?>
	document.getElementById('$$$_navigation__account').onclick = function(){location.href='<?php $this->setUrl('$$$showAccount', false, false); ?>';};
	document.getElementById('$$$_navigation__profile').onclick = function(){location.href='<?php $this->setUrl('$$$showProfile', false, false); ?>';};
	document.getElementById('$$$_navigation__logout').onclick = function(){location.href='<?php $this->setUrl('$$$doLogout', false, false); ?>';};
	<?php } else { ?>
	document.getElementById('$$$_navigation__showindex').onclick = function(){location.href='<?php $this->setUrl('$$$showIndex', false, false); ?>';};
	<?php } ?>
</script>