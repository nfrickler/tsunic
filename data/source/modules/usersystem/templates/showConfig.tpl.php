<!-- | TEMPLATE show config of user -->
<div id="$$$div__showConfig">
	<h1><?php $this->set('{SHOWCONFIG__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWCONFIG__INFOTEXT}'); ?>
	</p>

	<?php if ($TSunic->Usr->access('seeAllConfig')) { ?>
	<table>
		<tr>
			<th>
				<label for="$$$id"><?php $this->set('{SHOWCONFIG__CHOOSE_USER_LABEL}'); ?></label>
			</th>
		</tr>
		<tr>
			<td>
				<form action="?" method="get">
					<input type="hidden" name="event" value="$$$showConfig"/>
					<input type="hidden" name="hid" value="<?php echo ($TSunic->Temp->getCurrentHistoryId() + 1); ?>"/>
					<select name="$$$id" id="$$$id">
						<option value=""><?php $this->set('{SHOWCONFIG__CHOOSE_USER}'); ?></option>
						<?php foreach ($TSunic->Usr->allUsers() as $index => $value) { ?>
						<option value="<?php echo $index; ?>"><?php $this->set($value); ?></option>
						<?php } ?>
					</select>
					<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWCONFIG__CHOOSE_SUBMIT}'); ?>" />
				</form>
			</td>
		</tr>
	</table>
	<h2><?php $this->set('{SHOWCONFIG__SHOWCONFIGFROM}', array('name' => $this->getVar('User')->getInfo('name'))); ?></h2>
	<?php } ?>

	<form action="<?php $this->setUrl('$$$setConfig'); ?>" method="post">
		<input type="hidden" name="$$$showConfig__id" id="$$$showConfig__id" value="<?php echo $this->getVar('User')->getInfo('id'); ?>" />
		<?php foreach ($this->getVar('config') as $index => $values) { ?>
		<h2><?php $this->set($index); ?></h2>
		<table cellspacing="2" cellpadding="0" border="0">
			<tr>
				<th><?php $this->set('{SHOWCONFIG__NAME}'); ?></th>
				<th><?php $this->set('{SHOWCONFIG__VALUE}'); ?></th>
				<th><?php $this->set('{SHOWCONFIG__DEFAULT}'); ?></th>
				<th><?php $this->set('{SHOWCONFIG__DESCRIPTION}'); ?></th>
			</tr>
			<?php foreach ($values as $in => $val) { ?>
			<?php $preset = $this->setPreset('$$$showConfig__'.$in, $val['value'], false); ?>
			<tr>
				<td><?php $this->set($val['name']); ?></td>
				<td>
					<?php if ($val['formtype'] == "select") { ?>
					<?php if ($val['editable']) { ?>
					<select id="$$$showConfig__<?php echo $in; ?>" name="$$$showConfig__<?php echo $in; ?>">
						<option value="" <?php if (!$preset) echo 'selected="selected"'; ?>><?php $this->set('{SHOWCONFIG__USEDEFAULT}'); ?></option>
						<?php foreach ($val['options'] as $i => $v) { ?>
						<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php $this->set($v); ?></option>
						<?php } ?>
					</select>
					<?php } else { ?>
					<?php $this->set($val['options'][$val['value']]); ?>
					<?php } ?>
					<?php } elseif ($val['formtype'] == 'text') { ?>
					<?php if ($val['editable']) { ?>
					<input type="text" id="$$$showConfig__<?php echo $in; ?>" name="$$$showConfig__<?php echo $in; ?>" value="<?php $this->setPreset('$$$showConfig__'.$in, $val['value']); ?>" />
					<?php } else { ?>
					<?php $this->set($val['value'] ? $val['value'] : '{SHOWCONFIG__USEDEFAULT}'); ?>
					<?php } ?>
					<?php } else { ?>
					<?php $this->set($val['value'] ? $val['value'] : '{SHOWCONFIG__USEDEFAULT}'); ?>
					<?php } ?>
				</td>
				<td>
					<?php if ($val['formtype'] == "select") { ?>
					<?php $this->set($val['options'][$val['default']]); ?>
					<?php } else { ?>
					<?php $this->set($val['default']); ?>
					<?php } ?>
				</td>
				<td><?php $this->set($val['description']); ?></td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
		<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWCONFIG__SUBMIT}'); ?>" />
	</form>
</div>
