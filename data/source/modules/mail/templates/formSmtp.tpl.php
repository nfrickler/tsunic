<!-- | Template: form for SMTP -->
<?php
$Smtp = $this->getVar('Smtp');
?>
<div id="$$$div__formSmtp">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formSmtp__form" id="$$$formSmtp__form" class="ts_form">
		<input type="hidden" name="$$$formSmtp__id" id="$$$formSmtp__id" value="<?php $this->set($Smtp->getInfo('id')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMSMTP__LEGEND_SMTPMAILACCOUNT}'); ?></legend>
			<label for="$$$formSmtp__fk_mailaccount"><?php echo $this->set('{FORMSMTP__MAILACCOUNT}'); ?></label>
			<select name="$$$formSmtp__fk_mailaccount" id="$$$formSmtp__fk_mailaccount">
				<?php $current = $this->setPreset('$$$formSmtp__fk_mailaccount', $Smtp->getMailaccount(true), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMSMTP__MAILACCOUNT_NOMAILACCOUNT}'); ?></option>
				<?php foreach ($this->getVar('mailaccounts') as $index => $value) { ?>
				<option value="<?php echo $value->getInfo('id'); ?>" <?php if ($current == $value->getInfo('id')) echo 'selected="selected"'; ?>>
					<?php $this->set($value->getInfo('name')); ?>
				</option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__email"><?php echo $this->set('{FORMSMTP__EMAIL}'); ?></label>
			<input type="text" name="$$$formSmtp__email" id="$$$formSmtp__email" class="ts_required" value="<?php $this->setPreset('$$$formSmtp__email', $Smtp->getInfo('email')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__password"><?php echo $this->set('{FORMSMTP__PASSWORD}'); ?></label>
			<input type="password" name="$$$formSmtp__password" id="$$$formSmtp__password" class="ts_required" value="<?php $this->setPreset('$$$formSmtp__password', $Smtp->getInfo('password')); ?>" />
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php echo $this->set('{FORMMAILACCOUNT__LEGEND_OPTIONALDATA}'); ?></legend>
			<label for="$$$formSmtp__emailname"><?php echo $this->set('{FORMSMTP__EMAILNAME}'); ?></label>
			<input type="text" name="$$$formSmtp__emailname" id="$$$formSmtp__emailname" value="<?php $this->setPreset('$$$formSmtp__emailname', $Smtp->getInfo('emailname')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__description"><?php echo $this->set('{FORMSMTP__DESCRIPTION}'); ?></label>
			<textarea rows="2" name="$$$formSmtp__description" id="$$$formSmtp__description"><?php $this->setPreset('$$$formSmtp__description', $Smtp->getInfo('description')); ?></textarea>
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php echo $this->set('{FORMSMTP__LEGEND_CONNECTION}'); ?></legend>
			<label for="$$$formSmtp__host"><?php echo $this->set('{FORMSMTP__HOST}'); ?></label>
			<input type="text" name="$$$formSmtp__host" id="$$$formSmtp__host" value="<?php $this->setPreset('$$$formSmtp__host', $Smtp->getInfo('host')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__port"><?php echo $this->set('{FORMSMTP__PORT}'); ?></label>
			<input type="text" name="$$$formSmtp__port" id="$$$formSmtp__port" value="<?php $this->setPreset('$$$formSmtp__port', $Smtp->getInfo('port')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__user"><?php echo $this->set('{FORMSMTP__USER}'); ?></label>
			<input type="text" name="$$$formSmtp__user" id="$$$formSmtp__user" value="<?php $this->setPreset('$$$formSmtp__user', $Smtp->getInfo('user')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__connsecurity"><?php echo $this->set('{FORMSMTP__CONNSECURITY}'); ?></label>
			<select name="$$$formSmtp__connsecurity" id="$$$formSmtp__connsecurity">
				<?php $current = $this->setPreset('$$$formSmtp__connsecurity', $Smtp->getInfo('connsecurity'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMSMTP__CONNSECURITY_CHOOSE}'); ?></option>
				<?php foreach ($Smtp->getAllConnsecurities() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formSmtp__auth"><?php echo $this->set('{FORMSMTP__AUTH}'); ?></label>
			<select name="$$$formSmtp__auth" id="$$$formSmtp__auth">
				<?php $current = $this->setPreset('$$$formSmtp__auth', $Smtp->getInfo('auth'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMSMTP__AUTH_CHOOSE}'); ?></option>
				<?php foreach ($Smtp->getAllAuths() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->setVar('submit_text'); ?>" />
		<input type="reset" class="ts_reset" value="<?php $this->setVar('reset_text'); ?>" />
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formSmtp__allInputs = new Array();
	$$$formSmtp__allInputs[0] = new Array(
		'$$$formSmtp__fk_mailaccount',
		'<?php $this->set('{FORMSMTP__PRESET_MAILACCOUNT}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_MAILACCOUNT}'); ?>'
	);
	$$$formSmtp__allInputs[1] = new Array(
		'$$$formSmtp__email',
		'<?php $this->set('{FORMSMTP__PRESET_EMAIL}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_EMAIL}'); ?>'
	);
	$$$formSmtp__allInputs[2] = new Array(
		'$$$formSmtp__password',
		'*******',
		'<?php $this->set('{FORMSMTP__HELP_PASSWORD}'); ?>'
	);
	$$$formSmtp__allInputs[3] = new Array(
		'$$$formSmtp__emailname',
		'<?php $this->set('{FORMSMTP__PRESET_EMAILNAME}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_EMAILNAME}'); ?>'
	);
	$$$formSmtp__allInputs[4] = new Array(
		'$$$formSmtp__description',
		'<?php $this->set('{FORMSMTP__PRESET_DESCRIPTION}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_DESCRIPTION}'); ?>'
	);
	$$$formSmtp__allInputs[5] = new Array(
		'$$$formSmtp__host',
		'<?php $this->set('{FORMSMTP__PRESET_HOST}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_HOST}'); ?>'
	);
	$$$formSmtp__allInputs[6] = new Array(
		'$$$formSmtp__port',
		'<?php $this->set('{FORMSMTP__PRESET_PORT}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_PORT}'); ?>'
	);
	$$$formSmtp__allInputs[7] = new Array(
		'$$$formSmtp__user',
		'<?php $this->set('{FORMSMTP__PRESET_USER}'); ?>',
		'<?php $this->set('{FORMSMTP__HELP_USER}'); ?>'
	);
	$$$formSmtp__allInputs[8] = new Array(
		'$$$formSmtp__auth',
		false,
		'<?php $this->set('{FORMSMTP__HELP_AUTH}'); ?>'
	);
	$$$formSmtp__allInputs[9] = new Array(
		'$$$formSmtp__connsecurity',
		false,
		'<?php $this->set('{FORMSMTP__HELP_CONNSECURITY}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formSmtp__form'), $$$formSmtp__allInputs);

</script>
