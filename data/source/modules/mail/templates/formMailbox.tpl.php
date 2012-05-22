<!-- | TEMPLATE show form for local mailbox -->
<?php
$mailbox = $this->getVar('mailbox');
?>
<div id="$$$div__formMailbox">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formMailbox__form" id="$$$formMailbox__form" class="ts_form">
		<input type="hidden" name="$$$formMailbox__id_mail__box" id="$$$formMailbox__id_mail__box" value="<?php $this->set($mailbox->getInfo('id')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMMAILBOX__LEGEND}'); ?></legend>
			<label for="$$$formMailbox__name"><?php echo $this->set('{FORMMAILBOX__NAME}'); ?></label>
			<input class="ts_required" type="text" name="$$$formMailbox__name" id="$$$formMailbox__name" value="<?php $this->setPreset('$$$formMailbox__name', $mailbox->getInfo('name')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailbox__description"><?php echo $this->set('{FORMMAILBOX__DESCRIPTION}'); ?></label>
			<textarea name="$$$formMailbox__description" id="$$$formMailbox__description"><?php $this->setPreset('$$$formMailbox__description', $mailbox->getInfo('description')); ?></textarea>
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
		<input type="reset" class="ts_reset" value="<?php $this->set('#reset_text#'); ?>" />
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formMailbox__allInputs = new Array();
	$$$formMailbox__allInputs[0] = new Array(
		'$$$formMailbox__name',
		'<?php $this->setjs('{FORMMAILBOX__PRESET_NAME}'); ?>',
		'<?php $this->setjs('{FORMMAILBOX__HELP_NAME}'); ?>');
	$$$formMailbox__allInputs[1] = new Array(
		'$$$formMailbox__description',
		'<?php $this->setjs('{FORMMAILBOX__PRESET_DESCRIPTION}'); ?>',
		'<?php $this->setjs('{FORMMAILBOX__HELP_DESCRIPTION}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formMailbox__form'), $$$formMailbox__allInputs);

</script>
