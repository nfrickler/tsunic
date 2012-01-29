<!-- | TEMPLATE - header-navigation -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			templates/navigation_header.tpl.php
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
<div id="$$$div__navigation_header">
	<ul style="float:left;">
		<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
			<?php $this->displaySub('left_on'); ?>
		<?php } else { ?>
			<?php $this->displaySub('left_off'); ?>
		<?php } ?>
		<?php $this->displaySub('left'); ?>
	</ul>
	<ul style="float:right;">
		<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
			<?php $this->displaySub('right_on'); ?>

		<li id="$$$navigation_header__system" class="$$$navigation_header_important">
			<a href="<?php $this->setUrl('$system$showMain'); ?>">
				<?php $this->set('{NAVIGATION_HEADER__SYSTEM}'); ?>
			</a>
		</li>
		<?php } else { ?>
		<?php $this->displaySub('right_off'); ?>
		<li id="$$$navigation_header__showIndex" class="$$$navigation_header_important">
			<a href="<?php $this->setUrl('$usersystem$showIndex'); ?>">
				<?php $this->set('{NAVIGATION_HEADER__TOSHOWINDEX}'); ?>
			</a>
		</li>
		<?php } ?>
		<?php $this->displaySub('right'); ?>
	</ul>
	<div style="clear:both;"></div>
</div>
<script type="text/javascript">

	// add events
	<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
	document.getElementById('$$$navigation_header__system').onclick = function(){location.href='<?php $this->setUrl('$$$showMain', false, false); ?>';};
	<?php } else { ?>
	document.getElementById('$$$navigation_header__showIndex').onclick = function(){location.href='<?php $this->setUrl('$usersystem$showIndex', false, false); ?>';};
	<?php } ?>

</script>