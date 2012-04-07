<!-- | Template: form for mailaccount -->
<?php

// get input
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="div_$$$formAccount">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formAccount__form" id="$$$formAccount__form" class="ts_form">
		<input type="hidden" name="$$$formAccount__id_mail__account" class="ts_input" value="<?php $this->setPreset('0', $Mailaccount->getInfo('id_mail__account')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMACCOUNT__LEGEND_EMAILACCOUNT}'); ?></legend>
			<label for="$$$formAccount__name"><?php echo $this->set('{FORMACCOUNT__NAME}'); ?></label>
			<input type="text" name="$$$formAccount__name" id="$$$formAccount__name" value="<?php $this->setPreset('$$$formAccount__name', $Mailaccount->getInfo('name')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__description"><?php echo $this->set('{FORMACCOUNT__DESCRIPTION}'); ?></label>
			<textarea rows="2" name="$$$formAccount__description" id="$$$formAccount__description"><?php $this->setPreset('$$$formAccount__description', $Mailaccount->getInfo('description')); ?></textarea>
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php echo $this->set('{FORMACCOUNT__LEGEND_LOGINDATA}'); ?></legend>
			<label for="$$$formAccount__email"><?php echo $this->set('{FORMACCOUNT__EMAIL}'); ?></label>
			<input class="ts_required" type="text" name="$$$formAccount__email" id="$$$formAccount__email" value="<?php $this->setPreset('$$$formAccount__email', $Mailaccount->getInfo('email')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__password"><?php echo $this->set('{FORMACCOUNT__PASSWORD}'); ?></label>
			<input class="ts_required" type="password" name="$$$formAccount__password" id="$$$formAccount__password" value="<?php $this->setPreset('$$$formAccount__password', $Mailaccount->getInfo('password')); ?>" />
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php $this->set('{FORMACCOUNT__LEGEND_CONNECTION}'); ?></legend>
			<label for="$$$formAccount__protocol"><?php echo $this->set('{FORMACCOUNT__PROTOCOL}'); ?></label>
			<select name="$$$formAccount__protocol" id="$$$formAccount__protocol">
				<?php $current = $this->setPreset('$$$formAccount__protocol', $Mailaccount->getInfo('protocol'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMACCOUNT__PROTOCOL_CHOOSE}'); ?></option>
				<?php foreach ($Mailaccount->getAllProtocols() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formAccount__host"><?php echo $this->set('{FORMACCOUNT__HOST}'); ?></label>
			<input type="text" name="$$$formAccount__host" id="$$$formAccount__host" value="<?php $this->setPreset('$$$formAccount__host', $Mailaccount->getInfo('host')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__port"><?php echo $this->set('{FORMACCOUNT__PORT}'); ?></label>
			<input type="text" name="$$$formAccount__port" id="$$$formAccount__port" value="<?php $this->setPreset('$$$formAccount__port', $Mailaccount->getInfo('port')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__user"><?php echo $this->set('{FORMACCOUNT__USER}'); ?></label>
			<input type="text" name="$$$formAccount__user" id="$$$formAccount__user" value="<?php $this->setPreset('$$$formAccount__user', $Mailaccount->getInfo('user')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccount__connsecurity"><?php echo $this->set('{FORMACCOUNT__CONNSECURITY}'); ?></label>
			<select name="$$$formAccount__connsecurity" id="$$$formAccount__connsecurity">
				<?php $current = $this->setPreset('$$$formAccount__connsecurity', $Mailaccount->getInfo('connsecurity'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMACCOUNT__CONNSECURITY_CHOOSE}'); ?></option>
				<?php foreach ($Mailaccount->getAllConnsecurities() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formAccount__auth"><?php echo $this->set('{FORMACCOUNT__AUTH}'); ?></label>
			<select name="$$$formAccount__auth" id="$$$formAccount__auth">
				<?php $current = $this->setPreset('$$$formAccount__auth', $Mailaccount->getInfo('auth'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMACCOUNT__AUTH_CHOOSE}'); ?></option>
				<?php foreach ($Mailaccount->getAllAuths() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->setVar('submit_text'); ?>" />
		<input type="reset" class="ts_reset" value="<?php $this->setVar('reset_text'); ?>" />
	</form>
	<p class="ts_infotext">
		<?php $this->set('{FORMACCOUNT__SUBINFO}'); ?>
	</p>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formAccount__allInputs = new Array();
	$$$formAccount__allInputs[0] = new Array(
		'$$$formAccount__name',
		'<?php $this->set('{FORMACCOUNT__PRESET_NAME}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_NAME}'); ?>'
	);
	$$$formAccount__allInputs[1] = new Array(
		'$$$formAccount__description',
		'<?php $this->set('{FORMACCOUNT__PRESET_DESCRIPTION}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_DESCRIPTION}'); ?>'
	);
	$$$formAccount__allInputs[2] = new Array(
		'$$$formAccount__email',
		'<?php $this->set('{FORMACCOUNT__PRESET_EMAIL}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_EMAIL}'); ?>'
	);
	$$$formAccount__allInputs[3] = new Array(
		'$$$formAccount__password',
		'*******',
		'<?php $this->set('{FORMACCOUNT__HELP_PASSWORD}'); ?>'
	);
	$$$formAccount__allInputs[4] = new Array(
		'$$$formAccount__host',
		'<?php $this->set('{FORMACCOUNT__PRESET_HOST}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_HOST}'); ?>'
	);
	$$$formAccount__allInputs[5] = new Array(
		'$$$formAccount__port',
		'<?php $this->set('{FORMACCOUNT__PRESET_PORT}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_PORT}'); ?>'
	);
	$$$formAccount__allInputs[6] = new Array(
		'$$$formAccount__user',
		'<?php $this->set('{FORMACCOUNT__PRESET_USER}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_USER}'); ?>'
	);
	$$$formAccount__allInputs[7] = new Array(
		'$$$formAccount__protocol',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_PROTOCOL}'); ?>'
	);
	$$$formAccount__allInputs[8] = new Array(
		'$$$formAccount__auth',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_AUTH}'); ?>'
	);
	$$$formAccount__allInputs[9] = new Array(
		'$$$formAccount__connsecurity',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_CONNSECURITY}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formAccount__form'), $$$formAccount__allInputs);

</script>
