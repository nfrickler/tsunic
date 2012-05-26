<!-- | Template: form for serverbox -->
<?php
$Serverbox = $this->getVar('Serverbox');
$mailboxes = $this->getVar('mailboxes');
?>
<div id="$$$div__formServerbox">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" id="$$$formServerbox__form" class="ts_form">
		<input type="hidden" name="$$$formServerbox__id" value="<?php $this->set($Serverbox->getInfo('id')); ?>" />
		<input type="hidden" name="$$$formServerbox__fk_mailaccount" value="<?php $this->set($Serverbox->getInfo('fk_mailaccount')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMSERVERBOX__LEGEND}'); ?></legend>
			<label for="$$$formServerbox__name" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__NAME}'); ?></label>
			<input type="text" class="ts_required" name="$$$formServerbox__name" id="$$$formServerbox__name" value="<?php $this->setPreset('$$$formServerbox__name', $Serverbox->getInfo('name')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formServerbox__selectMailbox" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__SELECTMAILBOX}'); ?></label>
			<select name="$$$formServerbox__fk_mailbox" id="$$$formServerbox__fk_mailbox" class="ts_required">
				<?php $selectedPreset = $this->setPreset('$$$formServerbox__fk_mailbox', $Serverbox->getInfo('fk_mailbox'), false); ?>
				<option value="new" <?php if ($selectedPreset == 'new') echo 'selected="selected"'; ?>><?php $this->set('{FORMSERVERBOX__SELECTMAILBOX_CREATENEW}'); ?></option>
				<?php foreach ($mailboxes as $index => $value) { ?>
				<?php if ($value->getInfo('id') == $selectedPreset) { ?>
				<option value="<?php echo $value->getInfo('id'); ?>" selected="selected"><?php $this->set($value->getInfo('name')); ?></option>
				<?php } else { ?>
				<option value="<?php echo $value->getInfo('id'); ?>"><?php $this->set($value->getInfo('name')); ?></option> 	
				<?php } ?>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<div id="$$$formServerbox__newMailbox_div">
				<label for="$$$formServerbox__newMailbox" class="ts_form_required"><?php echo $this->set('{FORMSERVERBOX__TOMAILBOX_CREATENEW}'); ?></label>
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
	$$$formServerbox__allInputs[0] = new Array(
		'$$$formServerbox__name',
		'<?php $this->set('{FORMSERVERBOX__PRESET_NAME}'); ?>',
		'<?php $this->set('{FORMSERVERBOX__HELP_NAME}'); ?>');
	$$$formServerbox__allInputs[1] = new Array(
		'$$$formServerbox__fk_mailbox',
		false,
		'<?php $this->set('{FORMSERVERBOX__HELP_SELECTMAILBOX}'); ?>'
	);
	$$$formServerbox__allInputs[2] = new Array(
		'$$$formServerbox__newMailbox',
		'<?php $this->set('{FORMSERVERBOX__PRESET_NEWMAILBOX}'); ?>',
		'<?php $this->set('{FORMSERVERBOX__HELP_NEWMAILBOX}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formServerbox__form'), $$$formServerbox__allInputs);

	// hide $$$formServerbox__newMailbox_div, if no new mailbox selected
	document.getElementById('$$$formServerbox__fk_mailbox').onchange = function(){

		// get value and object
		var value = document.getElementById('$$$formServerbox__fk_mailbox').value;
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
