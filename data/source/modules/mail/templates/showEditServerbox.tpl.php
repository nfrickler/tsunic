<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showEditServerbox.tpl.php
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
<div id="$$$div__showEditMailserver">
	<h1><?php $this->set('{SHOWEDITSERVERBOX__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showDeleteServerbox', array('id_mail__serverbox' => $this->getVar('Serverbox')->getInfo('id_mail__serverbox'))); ?>">
			<?php $this->set('{SHOWEDITSERVERBOX__TODELETESERVERBOX}'); ?></a>
	</p>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITSERVERBOX__INFO}'); ?></p>
	<?php $this->display('$$$formServerbox', array('Serverbox' => $this->getVar('Serverbox'),
													  'mailboxes' => $this->getVar('mailboxes'),
						 							  'submit_text' => '{SHOWEDITSERVERBOX__SUBMIT}',
													  'reset_text' => '{SHOWEDITSERVERBOX__RESET}',
													  'submit_href_event' => '$$$editServerbox')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('back'); ?>">
			<?php $this->set('{SHOWEDITSERVERBOX__TOOVERVIEW}'); ?></a>
	</p>
</div>