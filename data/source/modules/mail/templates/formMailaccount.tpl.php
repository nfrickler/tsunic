<!-- | Template: form for mailaccount -->
<?php
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="div_$$$formMailaccount">
	<form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formMailaccount__form" id="$$$formMailaccount__form" class="ts_form">
		<input type="hidden" name="$$$formMailaccount__id_mail__account" class="ts_input" value="<?php $this->setPreset('0', $Mailaccount->getInfo('id')); ?>" />
		<fieldset>
			<legend><?php echo $this->set('{FORMACCOUNT__LEGEND_EMAILACCOUNT}'); ?></legend>
			<label for="$$$formMailaccount__name"><?php echo $this->set('{FORMACCOUNT__NAME}'); ?></label>
			<input type="text" name="$$$formMailaccount__name" id="$$$formMailaccount__name" value="<?php $this->setPreset('$$$formMailaccount__name', $Mailaccount->getInfo('name')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__description"><?php echo $this->set('{FORMACCOUNT__DESCRIPTION}'); ?></label>
			<textarea rows="2" name="$$$formMailaccount__description" id="$$$formMailaccount__description"><?php $this->setPreset('$$$formMailaccount__description', $Mailaccount->getInfo('description')); ?></textarea>
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php echo $this->set('{FORMACCOUNT__LEGEND_LOGINDATA}'); ?></legend>
			<label for="$$$formMailaccount__email"><?php echo $this->set('{FORMACCOUNT__EMAIL}'); ?></label>
			<input class="ts_required" type="text" name="$$$formMailaccount__email" id="$$$formMailaccount__email" value="<?php $this->setPreset('$$$formMailaccount__email', $Mailaccount->getInfo('email')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__password"><?php echo $this->set('{FORMACCOUNT__PASSWORD}'); ?></label>
			<input class="ts_required" type="password" name="$$$formMailaccount__password" id="$$$formMailaccount__password" value="<?php $this->setPreset('$$$formMailaccount__password', $Mailaccount->getInfo('password')); ?>" />
			<div style="clear:both;"></div>
		</fieldset>
		<fieldset>
			<legend><?php $this->set('{FORMACCOUNT__LEGEND_CONNECTION}'); ?></legend>
			<label for="$$$formMailaccount__protocol"><?php echo $this->set('{FORMACCOUNT__PROTOCOL}'); ?></label>
			<select name="$$$formMailaccount__protocol" id="$$$formMailaccount__protocol">
				<?php $current = $this->setPreset('$$$formMailaccount__protocol', $Mailaccount->getInfo('protocol'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMACCOUNT__PROTOCOL_CHOOSE}'); ?></option>
				<?php foreach ($Mailaccount->getAllProtocols() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__host"><?php echo $this->set('{FORMACCOUNT__HOST}'); ?></label>
			<input type="text" name="$$$formMailaccount__host" id="$$$formMailaccount__host" value="<?php $this->setPreset('$$$formMailaccount__host', $Mailaccount->getInfo('host')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__port"><?php echo $this->set('{FORMACCOUNT__PORT}'); ?></label>
			<input type="text" name="$$$formMailaccount__port" id="$$$formMailaccount__port" value="<?php $this->setPreset('$$$formMailaccount__port', $Mailaccount->getInfo('port')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__user"><?php echo $this->set('{FORMACCOUNT__USER}'); ?></label>
			<input type="text" name="$$$formMailaccount__user" id="$$$formMailaccount__user" value="<?php $this->setPreset('$$$formMailaccount__user', $Mailaccount->getInfo('user')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__connsecurity"><?php echo $this->set('{FORMACCOUNT__CONNSECURITY}'); ?></label>
			<select name="$$$formMailaccount__connsecurity" id="$$$formMailaccount__connsecurity">
				<?php $current = $this->setPreset('$$$formMailaccount__connsecurity', $Mailaccount->getInfo('connsecurity'), false); ?>
				<option value="0" <?php if (empty($current)) echo 'selected="selected"'; ?>><?php $this->set('{FORMACCOUNT__CONNSECURITY_CHOOSE}'); ?></option>
				<?php foreach ($Mailaccount->getAllConnsecurities() as $index => $value) { ?>
				<option value="<?php echo $index; ?>" <?php if ($current == $index) echo 'selected="selected"'; ?>><?php $this->set($value[0]); ?></option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
			<label for="$$$formMailaccount__auth"><?php echo $this->set('{FORMACCOUNT__AUTH}'); ?></label>
			<select name="$$$formMailaccount__auth" id="$$$formMailaccount__auth">
				<?php $current = $this->setPreset('$$$formMailaccount__auth', $Mailaccount->getInfo('auth'), false); ?>
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
	var $$$formMailaccount__allInputs = new Array();
	$$$formMailaccount__allInputs[0] = new Array(
		'$$$formMailaccount__name',
		'<?php $this->set('{FORMACCOUNT__PRESET_NAME}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_NAME}'); ?>'
	);
	$$$formMailaccount__allInputs[1] = new Array(
		'$$$formMailaccount__description',
		'<?php $this->set('{FORMACCOUNT__PRESET_DESCRIPTION}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_DESCRIPTION}'); ?>'
	);
	$$$formMailaccount__allInputs[2] = new Array(
		'$$$formMailaccount__email',
		'<?php $this->set('{FORMACCOUNT__PRESET_EMAIL}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_EMAIL}'); ?>'
	);
	$$$formMailaccount__allInputs[3] = new Array(
		'$$$formMailaccount__password',
		'*******',
		'<?php $this->set('{FORMACCOUNT__HELP_PASSWORD}'); ?>'
	);
	$$$formMailaccount__allInputs[4] = new Array(
		'$$$formMailaccount__host',
		'<?php $this->set('{FORMACCOUNT__PRESET_HOST}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_HOST}'); ?>'
	);
	$$$formMailaccount__allInputs[5] = new Array(
		'$$$formMailaccount__port',
		'<?php $this->set('{FORMACCOUNT__PRESET_PORT}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_PORT}'); ?>'
	);
	$$$formMailaccount__allInputs[6] = new Array(
		'$$$formMailaccount__user',
		'<?php $this->set('{FORMACCOUNT__PRESET_USER}'); ?>',
		'<?php $this->set('{FORMACCOUNT__HELP_USER}'); ?>'
	);
	$$$formMailaccount__allInputs[7] = new Array(
		'$$$formMailaccount__protocol',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_PROTOCOL}'); ?>'
	);
	$$$formMailaccount__allInputs[8] = new Array(
		'$$$formMailaccount__auth',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_AUTH}'); ?>'
	);
	$$$formMailaccount__allInputs[9] = new Array(
		'$$$formMailaccount__connsecurity',
		false,
		'<?php $this->set('{FORMACCOUNT__HELP_CONNSECURITY}'); ?>'
	);

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formMailaccount__form'), $$$formMailaccount__allInputs);

</script>
