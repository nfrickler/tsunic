<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			templates/_navigation_header.tpl.php
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
<li id="$$$_navigation_header__showLogin">
	<a href="<?php $this->setUrl('$$$showLogin'); ?>">
		<?php $this->set('{_HEADER_NAVIGATION__SHOWLOGIN}'); ?>
	</a>
</li>
<li id="$$$_navigation_header__showRegistration">
	<a href="<?php $this->setUrl('$$$showRegistration'); ?>">
		<?php $this->set('{_HEADER_NAVIGATION__SHOWREGISTRATION}'); ?>
	</a>
</li>

<script type="text/javascript">

	// add events
	document.getElementById('$$$_navigation_header__showLogin').onclick = function(){location.href='<?php $this->setUrl('$$$showLogin', false, false); ?>';};
	document.getElementById('$$$_navigation_header__showRegistration').onclick = function(){location.href='<?php $this->setUrl('$$$showRegistration', false, false); ?>';};

</script>