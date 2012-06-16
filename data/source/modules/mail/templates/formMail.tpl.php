<!-- | TEMPLATE show form for mail -->
<?php
$Mail = $this->getVar('Mail');
?>
<div id="$$$div__formMail">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formMail__form" id="$$$formMail__form" class="ts_form">
		<input type="hidden" name="$$$formMail__id" id="$$$formMail__id" value="<?php $this->set($Mail->getInfo('id')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMMAIL__LEGEND_HEADER}'); ?></legend>
			<label for="$$$formMail__fk_smtp"><?php $this->set('{FORMMAIL__SENDER}'); ?></label>
			<select name="$$$formMail__fk_smtp" id="$$$formMail__fk_smtp">
				<?php $selected = $this->setPreset('$$$formMail__fk_smtp', $Mail->getInfo('addressee'), false); ?>
				<?php foreach ($this->getVar('smtps') as $index => $Value) { ?>
				<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($selected == $Value->getInfo('id')) echo "selected='selected'"; ?>>
					<?php $this->set($Value->getInfo('emailname')); ?>
					&lt;<?php $this->set($Value->getInfo('email')); ?>&gt;
				</option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formMail__addressee"><?php $this->set('{FORMMAIL__ADDRESSEE}'); ?></label>
			<input class="ts_required" type="text" name="$$$formMail__addressee" id="$$$formMail__addressee" value="<?php $this->setPreset('$$$formMail__addressee', $Mail->getAddressee()); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMail__subject"><?php $this->set('{FORMMAIL__SUBJECT}'); ?></label>
			<input class="ts_required" type="text" name="$$$formMail__subject" id="$$$formMail__subject" value="<?php $this->setPreset('$$$formMail__subject', $Mail->getInfo('subject')); ?>" />
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php echo $this->set('{FORMMAIL__LEGEND_CONTENT}'); ?></legend>
			<label for="$$$formMail__content"><?php echo $this->set('{FORMMAIL__CONTENT}'); ?></label>
			<textarea name="$$$formMail__content" rows="20" id="$$$formMail__content"><?php $this->setPreset('$$$formMail__content', $Mail->getPlainContent()); ?></textarea>
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" name="$$$formMail__send" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
		<input type="submit" name="$$$formMail__save" class="ts_submit" value="<?php $this->set('#save_text#'); ?>" />
		<?php if ($this->getVar('cancel_href')) { ?>
		<a class="ts_cancel" href="<?php echo $this->getVar('cancel_href'); ?>">
		    <?php $this->set('#reset_text#'); ?></a>
		<?php } ?>
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formMail__allInputs = new Array();
	$$$formMail__allInputs[0] = new Array(
		'$$$formMail__fk_smtp',
		'',
		'<?php $this->setjs('{FORMMAIL__HELP_SENDER}'); ?>');
	$$$formMail__allInputs[1] = new Array(
		'$$$formMail__subject',
		'<?php $this->setjs('{FORMMAIL__PRESET_SUBJECT}'); ?>',
		'<?php $this->setjs('{FORMMAIL__HELP_SUBJECT}'); ?>'
	);
	$$$formMail__allInputs[2] = new Array(
		'$$$formMail__addressee',
		'<?php $this->setjs('{FORMMAIL__PRESET_ADDRESSEE}'); ?>',
		'<?php $this->setjs('{FORMMAIL__HELP_ADDRESSEE}'); ?>'
	);
	$$$formMail__allInputs[3] = new Array(
		'$$$formMail__content',
		'<?php $this->setjs('{FORMMAIL__PRESET_CONTENT}'); ?>',
		'<?php $this->setjs('{FORMMAIL__HELP_CONTENT}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formMail__form'), $$$formMail__allInputs);

</script>
