<!-- | TEMPLATE delete member from accessgroup? -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
$User = $this->getVar('User');
?>
<div id="$$$div__showDeleteAccessgroupmember">
<h1><?php $this->set('{SHOWDELETEACCESSGROUPMEMBER__H1}', array(
		'name' => $Accessgroup->getInfo('name'),
		'username' => $User->getInfo('name'),
	)); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWDELETEACCESSGROUPMEMBER__INFOTEXT}'); ?>
	</p>
	<a style="ts_submit" href="<?php $this->setUrl('$$$deleteAccessgroupmember',
		array(
			'$$$id' => $Accessgroup->getInfo('id'),
			'$$$userid' => $User->getInfo('id')
		)
	); ?>"><?php $this->set('{SHOWDELETEACCESSGROUPMEMBER__SUBMIT}'); ?></a>
	<a style="ts_cancel" href="<?php $this->setUrl('$$$showAccessgroupmembers', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEACCESSGROUPMEMBER__CANCEL}'); ?></a>
</div>
