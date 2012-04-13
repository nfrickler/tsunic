<!-- | TEMPLATE show config of user -->
<div id="$$$div__showConfig">
	<h1><?php $this->set('{SHOWCONFIG__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWCONFIG__INFOTEXT}'); ?>
	</p>

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
		<tr>
			<td><?php $this->set($val['name']); ?></td>
			<td>
				<?php if ($val['formtype'] == "select") { ?>
				<select id="$$$showConfig__<?php echo $in; ?>">
					<option value=""><?php $this->set('{SHOWCONFIG__USEDEFAULT}'); ?></option>
					<?php foreach ($val['options'] as $i => $v) { ?>
					<option value="<?php echo $i; ?>"><?php $this->set($v); ?></option>
					<?php } ?>
				</select>
				<?php } else { ?>
				<?php $this->set($val['value']); ?>
				<?php } ?>
			</td>
			<td><?php $this->set($val['default']); ?></td>
			<td><?php $this->set($val['description']); ?></td>
		</tr>
		<?php } ?>
	</table>
	<?php } ?>
</div>
