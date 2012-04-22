<!-- | TEMPLATE show access of user or accessgroup -->
<div id="$$$div__showAccess">
	<h1><?php $this->set('{SHOWACCESS__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWACCESS__INFOTEXT}'); ?>
	</p>

	<h2><?php $this->set('{SHOWACCESS__H_ACCESSOF}', array('name' => $this->getVar('User')->getInfo('name'))); ?></h2>
	<form action="<?php $this->setUrl('$$$setAccess'); ?>" method="post">
		<?php foreach ($this->getVar('accessnames') as $index => $values) { ?>
		<h3><?php $this->set($index); ?></h3>
		<table cellspacing="2" cellpadding="0" border="0">
			<tr>
				<th><?php $this->set('{SHOWACCESS__NAME}'); ?></th>
				<th><?php $this->set('{SHOWACCESS__VALUE}'); ?></th>
				<th><?php $this->set('{SHOWACCESS__BYGROUPS}'); ?></th>
				<th><?php $this->set('{SHOWACCESS__DESCRIPTION}'); ?></th>
			</tr>
			<?php foreach ($values as $in => $val) { ?>
			<?php $preset = $this->setPreset('$$$showAccess__'.$in, $val['value'], false); ?>
			<tr>
				<td><?php $this->set($val['name']); ?></td>
				<td>
					<?php if ($this->getVar('allowEdit')) { ?>
					<select id="$$$showAccess__<?php echo $in; ?>" name="$$$showAccess__<?php echo $in; ?>">
						<option value="" <?php if ($preset == NULL) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__USEDEFAULT}'); ?></option>
						<option value="" <?php if ($preset) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__YES}'); ?></option>
						<option value="" <?php if ($preset === false) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__NO}'); ?></option>
					</select>
					<?php } else { ?>
					<?php if ($default === NULL) $this->set('{SHOWACCESS__USEDEFAULT}'); ?>
					<?php if ($default === true) $this->set('{SHOWACCESS__YES}'); ?>
					<?php if ($default === false) $this->set('{SHOWACCESS__NO}'); ?>
					<?php } ?>
				</td>
				<td><?php $this->set($val['groups']); ?></td>
				<td><?php $this->set($val['description']); ?></td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
		<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCESS__SUBMIT}'); ?>" />
		<input type="reset" class="ts_reset" value="<?php $this->set('{SHOWACCESS__RESET}'); ?>" />
	</form>
</div>
