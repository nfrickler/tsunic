<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showEditAccount.tpl.php
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
<div id="$$$div__showEditAccount">
	<h1><?php $this->set('{SHOWEDITACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITACCOUNT__INFO}'); ?></p>
	<?php $this->display('$$$formAccount', array('Mailaccount' => $this->getVar('Mailaccount'),
						 							'submit_text' => '{SHOWEDITACCOUNT__SUBMIT}',
													'reset_text' => '{SHOWEDITACCOUNT__RESET}',
													'submit_href_event' => '$$$editAccount')); ?>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
			<?php $this->set('{SHOWEDITACCOUNT__TOBACK}'); ?></a>
	</p>
</div>