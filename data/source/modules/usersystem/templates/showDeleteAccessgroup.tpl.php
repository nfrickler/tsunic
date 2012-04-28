<!-- | TEMPLATE delete accessgroup? -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__showdeleteAccessgroup">
	<h1><?php $this->set('{SHOWDELETEACCESSGROUP__H1}',
		array('name' => $Accessgroup->getInfo('name'))
	); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWDELETEACCESSGROUP__INFOTEXT}'); ?>
	</p>
	<a style="ts_submit" href="<?php $this->setUrl('$$$deleteAccessgroup', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEACCESSGROUP__SUBMIT}'); ?></a>
	<a style="ts_cancel" href="<?php $this->setUrl('$$$showAccessgroup', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEACCESSGROUP__CANCEL}'); ?></a>
</div>
