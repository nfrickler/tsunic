<!-- | TEMPLATE show list of accessgroupmembers -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__showAccessgroupmembers">
    <h1><?php echo $this->set('{SHOWACCESSGROUPMEMBERS__H1}', array('name' => $Accessgroup->getInfo('name'))); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showAccessgroup', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWACCESSGROUPMEMBERS__TOSHOWACCESSGROUP}'); ?></a>
	<a href="<?php $this->setUrl('$$$showAddAccessgroupmember', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWACCESSGROUPMEMBERS__TOSHOWADDACCESSGROUPMEMBER}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWACCESSGROUPMEMBERS__INFOTEXT}'); ?>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php echo $this->set('{SHOWACCESSGROUPMEMBERS__NAME}'); ?></th>
	    <?php if ($TSunic->Usr->access('editAllAccess')) { ?>
	    <th><?php echo $this->set('{SHOWACCESSGROUPMEMBERS__ACTION}'); ?></th>
	    <?php } ?>
	</tr>
	<?php foreach ($this->getVar('members') as $userid => $username) { ?>
	<tr>
	    <td><?php $this->set($username); ?></td>
	    <?php if ($TSunic->Usr->access('editAllAccess')) { ?>
	    <td>
		<a href="<?php $this->setUrl(
		    '$$$showDeleteAccessgroupmember',
		    array(
			'$$$id' => $Accessgroup->getInfo('id'),
			'$$$userid' => $userid
		    )); ?>">
		<?php $this->set('{SHOWACCESSGROUPMEMBERS__DELETEMEMBER}'); ?></a>
	    </td>
	    <?php } ?>
	</tr>
	<?php } ?>
    </table>
</div>
