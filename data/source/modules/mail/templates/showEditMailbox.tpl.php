<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showEditMailbox.tpl.php
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

$mailbox = $this->getVar('mailbox');
?>
<div id="$$$div__showAddMailserver">
	<h1><?php $this->set('{SHOWEDITMAILBOX__H1}', $mailbox->getInfo('name')); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITMAILBOX__INFO}'); ?></p>
	<?php $this->display('$$$formMailbox', array('mailbox' => $mailbox,
						 						 'submit_text' => '{SHOWEDITAILBOX__SUBMIT}',
												 'reset_text' => '{SHOWEDITMAILBOX__RESET}',
												 'submit_href_event' => '$$$editMailbox')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
			<?php $this->set('{SHOWEDITMAILBOX__TOSHOWMAILBOXES}'); ?></a>
	</p>
</div>