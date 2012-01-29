<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/formServerbox.tpl.php
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

// get input
$Serverbox = $this->getVar('Serverbox');
$mailboxes = $this->getVar('mailboxes');
?>
<div id="$$$div__formServerbox">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" id="$$$formServerbox__form" class="ts_form">
		<input type="hidden" name="id_mail__serverbox" value="<?php $this->set($Serverbox->getInfo('id_mail__serverbox')); ?>" />
		<input type="hidden" name="id_mail__account" value="<?php $this->set($Serverbox->getInfo('fk_mail__account')); ?>" />
	    <fieldset>
	        <legend><?php echo $this->set('{FORMSERVERBOX__LEGEND}'); ?></legend>
	        <label for="$$$formServerbox__name" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__NAME}'); ?></label>
	        <input type="text" class="ts_required" name="$$$formServerbox__name" id="$$$formServerbox__name" value="<?php $this->setPreset('$$$formServerbox__name', $Serverbox->getInfo('name')); ?>" />
	        <div style="clear:both;"></div>
	        <label for="$$$formServerbox__selectMailbox" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__SELECTMAILBOX}'); ?></label>
	        <select name="$$$formServerbox__selectMailbox" id="$$$formServerbox__selectMailbox" class="ts_required">
	        	<?php $selectedPreset = $this->setPreset('$$$formServerbox__selectMailbox', $Serverbox->getInfo('fk_mail__box'), false); ?>
				<option value="new" <?php if ($selectedPreset == 'new') echo 'selected="selected"'; ?>><?php $this->set('{FORMSERVERBOX__SELECTMAILBOX_CREATENEW}'); ?></option>
	        	<?php foreach ($mailboxes as $index => $value) { ?>
	        	<?php if ($value->getInfo('id_mail__box') == $selectedPreset) { ?>
	        	<option value="<?php echo $value->getInfo('id_mail__box'); ?>" selected="selected"><?php $this->set($value->getInfo('name')); ?></option>
	        	<?php } else { ?>
	            <option value="<?php echo $value->getInfo('id_mail__box'); ?>"><?php $this->set($value->getInfo('name')); ?></option> 	
	        	<?php } ?>
	        	<?php } ?>
	        </select>
	        <div style="clear:both;"></div>
	        <div id="$$$formServerbox__newMailbox_div">
		        <label for="$$$formServerbox__newMailbox" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__TOBOX_CREATENEW}'); ?></label>
		        <input type="text" name="$$$formServerbox__newMailbox" id="$$$formServerbox__newMailbox" class="ts_input" value="<?php $this->setPreset('$$$formServerbox__newMailbox'); ?>" />
		        <div style="clear:both;"></div>
	        </div>
	    </fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	    <input type="reset" class="ts_reset" value="<?php $this->set('#reset_text#'); ?>" />
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formServerbox__allInputs = new Array();
	$$$formServerbox__allInputs[0] = new Array('$$$formServerbox__name',
												  '<?php $this->set('{FORMSERVERBOX__PRESET_NAME}'); ?>',
												  '<?php $this->set('{FORMSERVERBOX__HELP_NAME}'); ?>');
	$$$formServerbox__allInputs[1] = new Array('$$$formServerbox__selectMailbox',
												  false,
												  '<?php $this->set('{FORMSERVERBOX__HELP_SELECTMAILBOX}'); ?>');
	$$$formServerbox__allInputs[2] = new Array('$$$formServerbox__newMailbox',
												  '<?php $this->set('{FORMSERVERBOX__PRESET_NEWMAILBOX}'); ?>',
												  '<?php $this->set('{FORMSERVERBOX__HELP_NEWMAILBOX}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formServerbox__form'), $$$formServerbox__allInputs);

	// hide $$$formServerbox__newMailbox_div, if no new mailbox selected
	document.getElementById('$$$formServerbox__selectMailbox').onchange = function(){

		// get value and object
		var value = document.getElementById('$$$formServerbox__selectMailbox').value;
		var extrainput = document.getElementById('$$$formServerbox__newMailbox_div');

		if (value == 'new') {
			// show extra input
			extrainput.style.display = 'block';
		} else {
			// hide extra input
			extrainput.style.display = 'none';
		}
	};
	document.getElementById('$$$formServerbox__selectMailbox').onchange();

	// set focus on first field
	document.getElementById($$$formServerbox__allInputs[0][0]).focus();

</script>