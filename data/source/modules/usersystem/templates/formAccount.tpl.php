<!-- | TEMPLATE show form for user account -->
<?php
$User = $this->getVar('User');
?>
<div id="$$$div__formAccount">
	<form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formAccount__form" id="$$$formAccount__form" class="ts_form">
		<fieldset>
			<legend><?php $this->set('{FORMACCOUNT__LEGEND}'); ?></legend>
			<label for="$$$formAccount__name"><?php $this->set('{FORMACCOUNT__NAME}'); ?></label>
			<input type="text" class="ts_required" name="$$$formAccount__name" id="$$$formAccount__name" value="<?php $this->setPreset('$$$formAccount__name', ($User->isGuest() ? "" : $User->getInfo('name'))); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__email"><?php $this->set('{FORMACCOUNT__EMAIL}'); ?></label>
			<input type="text" class="ts_required" name="$$$formAccount__email" id="$$$formAccount__email" value="<?php $this->setPreset('$$$formAccount__email', $User->getInfo('email')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__password"><?php $this->set('{FORMACCOUNT__PASSWORD}'); ?></label>
			<input type="password" name="$$$formAccount__password" id="$$$formAccount__password" <?php if ($this->getVar('password_required')) echo 'class="ts_required"'; ?> />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__passwordrepeat"><?php $this->set('{FORMACCOUNT__PASSWORDREPEAT}'); ?></label>
			<input type="password" name="$$$formAccount__passwordrepeat" id="$$$formAccount__passwordrepeat" <?php if ($this->getVar('password_required')) echo 'class="ts_required"'; ?> />
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
		<?php if ($this->getVar('reset_text')) { ?>
		<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
			<?php $this->set('#reset_text#'); ?></a>
		<?php } ?>
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formAccount__allInputs = new Array();
	$$$formAccount__allInputs[0] = new Array('$$$formAccount__name',
		'<?php $this->setjs('{FORMACCOUNT__NAME_PRESET}'); ?>',
		'<?php $this->setjs('{FORMACCOUNT__NAME_HELP}'); ?>');
	$$$formAccount__allInputs[1] = new Array('$$$formAccount__email',
		'<?php $this->setjs('{FORMACCOUNT__EMAIL_PRESET}'); ?>',
		'<?php $this->setjs('{FORMACCOUNT__EMAIL_HELP}'); ?>');
	$$$formAccount__allInputs[2] = new Array('$$$formAccount__password',
		'*******',
		'<?php $this->setjs('{FORMACCOUNT__PASSWORD_HELP}'); ?>');
	$$$formAccount__allInputs[3] = new Array('$$$formAccount__passwordrepeat',
		'*******',
		'<?php $this->setjs('{FORMACCOUNT__PASSWORDREPEAT_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formAccount__form'), $$$formAccount__allInputs);
</script>
