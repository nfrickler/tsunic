<!-- | TEMPLATE show access of user or accessgroup -->
<div id="$$$div__showAccess">
    <h1><?php $this->set('{SHOWACCESS__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showAccessgroups'); ?>">
	    <?php $this->set('{SHOWACCESS__TOACCESSGROUPS}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWACCESS__INFOTEXT}'); ?>
    </p>
    <?php if ($TSunic->Usr->access('$$$seeAllAccess')) { ?>
    <table>
	<tr>
	    <th>
		<label for="$$$user"><?php $this->set('{SHOWACCESS__CHOOSE_USER_LABEL}'); ?></label>
	    </th>
	    <th>
		<label for="$$$group"><?php $this->set('{SHOWACCESS__CHOOSE_GROUP_LABEL}'); ?></label>
	    </th>
	</tr>
	<tr>
	    <td>
		<form action="?" method="get">
		    <input type="hidden" name="event" value="$$$showAccess"/>
		    <input type="hidden" name="hid" value="<?php echo ($TSunic->Temp->getCurrentHistoryId() + 1); ?>"/>
		    <select name="$$$user" id="$$$user">
			<option value=""><?php $this->set('{SHOWACCESS__CHOOSE_USER}'); ?></option>
			<?php foreach ($this->getVar('users') as $index => $value) { ?>
			<option value="<?php echo $index; ?>"><?php $this->set($value); ?></option>
			<?php } ?>
		    </select>
		    <input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCESS__CHOOSE_SUBMIT}'); ?>" />
		</form>
	    </td>
	    <td>
		<form action="?" method="get">
		    <input type="hidden" name="event" value="$$$showAccess"/>
		    <input type="hidden" name="hid" value="<?php echo ($TSunic->Temp->getCurrentHistoryId() + 1); ?>"/>
		    <select name="$$$group" id="$$$group">
			<option value=""><?php $this->set('{SHOWACCESS__CHOOSE_GROUP}'); ?></option>
			<?php foreach ($this->getVar('groups') as $index => $value) { ?>
			<option value="<?php echo $index; ?>"><?php $this->set($value); ?></option>
			<?php } ?>
		    </select>
		    <input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCESS__CHOOSE_SUBMIT}'); ?>" />
		</form>
	    </td>
	</tr>
    </table>
    <?php } ?>
    <h2><?php $this->set('{SHOWACCESS__H_ACCESSOF}'); ?></h2>
    <form action="<?php $this->setUrl('$$$setAccess'); ?>" method="post">
	<input type="hidden" name="$$$id" value="<?php echo $this->getVar('id'); ?>"\>
	<input type="hidden" name="$$$isuser" value="<?php echo $this->getVar('isuser') ? "1" : "0"; ?>"\>
	<?php foreach ($this->getVar('accessnames') as $index => $values) { ?>
	<h3><?php $this->set($index); ?></h3>
	<table cellspacing="2" cellpadding="0" border="0">
	    <tr>
		<th><?php $this->set('{SHOWACCESS__NAME}'); ?></th>
		<th><?php $this->set('{SHOWACCESS__VALUE}'); ?></th>
		<th><?php $this->set( $this->getVar('isuser')
		    ? '{SHOWACCESS__BYGROUPS}'
		    : '{SHOWACCESS__BYPARENT}'
		); ?></th>
		<th><?php $this->set('{SHOWACCESS__DESCRIPTION}'); ?></th>
	    </tr>
	    <?php foreach ($values as $in => $val) { ?>
	    <?php $preset = $this->setPreset('$$$showAccess__'.$in, $val['value'], false); ?>
	    <tr>
		<td><?php $this->set($val['name']); ?></td>
		<td>
		    <?php if ($this->getVar('allowEdit')) { ?>
		    <select id="$$$showAccess__<?php echo $in; ?>" name="$$$showAccess__<?php echo $in; ?>">
			<option value="" <?php if ($preset === NULL) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__USEDEFAULT}'); ?></option>
			<option value="1" <?php if ($preset) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__YES}'); ?></option>
			<option value="0" <?php if ($preset === false) echo 'selected="selected"'; ?>><?php $this->set('{SHOWACCESS__NO}'); ?></option>
		    </select>
		    <?php } else {
			if ($preset === NULL) {
			    $this->set('{SHOWACCESS__USEDEFAULT}');
			} elseif ($preset) {
			    $this->set('{SHOWACCESS__YES}');
			} else {
			    $this->set('{SHOWACCESS__NO}');
			}
		    } ?>
		</td>
		<td><?php $this->set($val['default']); ?></td>
		<td><?php $this->set($val['description']); ?></td>
	    </tr>
	    <?php } ?>
	</table>
	<?php } ?>
	<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCESS__SUBMIT}'); ?>" />
	<input type="reset" class="ts_reset" value="<?php $this->set('{SHOWACCESS__RESET}'); ?>" />
    </form>
</div>
