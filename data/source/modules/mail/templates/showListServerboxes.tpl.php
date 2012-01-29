<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showListServerboxes.tpl.php
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
﻿<!-- | -->
<?php


// activate javascript-functions
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$serverboxes = $this->getVar('serverboxes');
$selectable = $this->getVar('selectable');
?>
<div id="$$$div__showListServerboxes">
	<?php if (is_array($serverboxes) AND count($serverboxes) > 0) { ?>
	<table>
		<tr style="width:100%;">
			<?php if (!empty($selectable)) { ?>
			<th width="20">&nbsp;</th>
			<?php } ?>
			<th><?php $this->set('{SHOWLISTSERVERBOXES__NAME}'); ?></th>
			<th><?php $this->set('{SHOWLISTSERVERBOXES__FKMAILBOX}'); ?></th>
			<th>&nbsp;</th>
		</tr>
		<?php foreach ($serverboxes as $index => $value) { ?>
		<tr style="margin:1px; padding:5px;">
			<?php if (!empty($selectable)) { ?>
			<td>
				<input type="checkbox" id="<?php echo $selectable.$value->getInfo('id_mail__serverbox'); ?>" name="<?php echo $selectable.'_'.$value->getInfo('id_mail__serverbox'); ?>" <?php if ($value->getInfo('isActive') == 1) echo 'checked="checked"'; ?> />
			</td>
			<?php } ?>
			<td>
				<strong><?php $this->set($value->getInfo('name')); ?></strong>
			</td>
			<td>
				<?php $this->set($value->getInfo('Mailbox')->getInfo('name')); ?>
			</td>
			<td>
				<a href="<?php $this->setUrl('$$$showEditServerbox', array('id_mail__serverbox' => $value->getInfo('id_mail__serverbox')));?>">
					<img class="$system$editImage" src="<?php $this->setImg('project', '$system$edit.png'); ?>" alt="<?php $this->set('{SHOWLISTSERVERBOXES__EDIT}'); ?>" />
				</a>
				<a href="<?php $this->setUrl('$$$showDeleteServerbox', array('id_mail__serverbox' => $value->getInfo('id_mail__serverbox')));?>"  id="$$$showListServerbox__delete_<?php $this->set($value->getInfo('id_mail__serverbox')); ?>">
					<img class="$system$deleteImage" src="<?php $this->setImg('project', '$system$delete.png'); ?>" alt="<?php $this->set('{SHOWLISTSERVERBOXES__DELETE}'); ?>" />
				</a>
			</td>
		</tr>
		<?php } ?>
	</table>
	<?php } else { ?>
	<p>
		<?php $this->set('{SHOWLISTSERVERBOXES__NOSERVER}'); ?>
	</p>
	<?php } ?>
</div>

<script type="text/javascript">

	// get imaps
	var $$$showListServerboxes__all = new Array();
	<?php foreach ($serverboxes as $index => $Value) {
	echo '$$$showListServerboxes__all["id_'.$Value->getInfo('id_mail__serverbox').'"] = new Array("$$$showListServerbox__delete_'.$Value->getInfo('id_mail__serverbox').'",
																					   "'.$Value->getInfo('name').'",
																			   		   "'.$this->setUrl('$$$deleteServerbox', array('id_mail__serverbox' => $Value->getInfo('id_mail__serverbox')), false, false).'");';
	} ?>

	// add events
	for (arr_index in $$$showListServerboxes__all) {
		function $$$showListServerboxes__addEvents (input) {

			// get values
			var object = document.getElementById(input[0]);
			var name = input[1];
			var button1_href = input[2];

			// add onclick-event
			object.onclick = function(){

				// create optionbox
				var allobjects = $system$showOptionbox('<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_HEADER_JS}'); ?>',
													   '<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT}'); ?>',
													   '<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_YES}'); ?>',
													   '<?php $this->setjs('{SHOWDELETESERVERBOX__POPUP_DELETE_NO}'); ?>');

				// add no-button-event
				allobjects['button2'].onclick = function(){
					// remove background
					$system$removeElement(allobjects['background']);

					// remove popup
					$system$removeElement(allobjects['popup']);
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
		$$$showListServerboxes__addEvents($$$showListServerboxes__all[arr_index]);
	}

</script>