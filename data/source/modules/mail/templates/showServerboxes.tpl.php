<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showServerboxes.tpl.php
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

$Imap = $this->getVar('Imap');
$serverboxes = $this->getVar('serverboxes');
?>
<div id="div_mail__showServerboxes">
	<h1><?php $this->set('{SHOWSERVERBOXES__H1}', array('servername' => $Imap->getInfo('name'))); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWSERVERBOXES__INFO}'); ?></p>

	<?php if (count($serverboxes) > 0) { ?>
	<table cellspacing="1" cellpadding=5" border="0" style="width:100%;">
		<tr style="width:100%;">
			<th><?php $this->set('{SHOWSERVERBOXES__NAME}'); ?></th>
			<th><?php $this->set('{SHOWSERVERBOXES__TOMAILBOX}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($serverboxes as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<td>
				<?php $this->set($value->getInfo('name')); ?>
			</td>
			<td>
				<?php $this->set($value->getInfo('fk_mail__box_obj')->getInfo('name')); ?>
			</td>
			<td>
				<a href="<?php $this->setUrl('mail', 'showEditServerbox', array('id_mail__serverbox' => $value->getInfo('id_mail__serverbox')));?>">
					<img class="system_editImage" src="<?php $this->setImg('system', 'edit', 'png'); ?>" alt="<?php $this->set('{SHOWSERVERBOXES__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('mail', 'showDeleteServerbox', array('id_mail__serverbox' => $value->getInfo('id_mail__serverbox')));?>"  id="mail__showServerboxes__delete_<?php $this->set($value->getInfo('id_mail_serverbox')); ?>">
					<img class="system_deleteImage" src="<?php $this->setImg('system', 'delete', 'png'); ?>" alt="<?php $this->set('{SHOWSERVERBOXES__DELETE}'); ?>" />
				</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWSERVERBOXES__NOSERVERBOXES}'); ?>
	</p>
	<?php } ?>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddServerbox', array('id_mail__server' => $Imap->getInfo('id_mail__imap'))); ?>">
			<?php $this->set('{SHOWSERVERBOXES__ADDSERVERBOX}'); ?></a>
	</p>
</div>

<script type="text/javascript">

	// get mailservers
	var $$$showmailservers__all = new Array();
	<?php foreach ($TSunic->Temp->getCache('mailservers') as $index => $value) {
	echo '$$$showmailservers__all["id_'.$value->getInfo('id_$$$server').'"] = new Array("$$$showmailservers__delete_'.$value->getInfo('id_mail_server').'",
																					   "'.$value->getInfo('name').'",
																			   		   "'.$this->setUrl('mail', 'deleteMailserver', array('id_$$$server' => $value->getInfo('id_$$$server')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showmailservers__all) {
		function $$$showMailservers__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = system__showOptionbox('{SHOWDELETEMAILSERVER__POPUP_DELETE_HEADER_JS}', '{SHOWDELETEMAILSERVER__POPUP_DELETE_CONTENT}', '{SHOWDELETEMAILSERVER__POPUP_DELETE_YES}', '{SHOWDELETEMAILSERVER__POPUP_DELETE_NO}');

				// add no-button-event
				allobjects['button2'].onclick = function(){
					// remove background
					$$$removeElement(allobjects['background']);

					// remove popup
					$$$removeElement(allobjects['popup']);
				};

				// add yes-button-event
				allobjects['button1'].onclick = function(){

					// redirect
					location.href= button1_href;

				};

				// reset onclick
				return false;
			};

		}
		$$$showMailservers__addEvents($$$showmailservers__all[arr_index]);
	}

</script>