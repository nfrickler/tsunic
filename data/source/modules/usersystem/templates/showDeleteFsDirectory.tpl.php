<!-- | TEMPLATE delete accessgroup? -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showdeleteFsDirectory">
	<h1><?php $this->set('{SHOWDELETEFSDIRECTORY__H1}',
		array('name' => $Dir->getInfo('name'))
	); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWDELETEFSDIRECTORY__INFOTEXT}'); ?>
	</p>
	<a style="ts_submit" href="<?php $this->setUrl('$$$deleteFsDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEFSDIRECTORY__SUBMIT}'); ?></a>
	<a style="ts_cancel" href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEFSDIRECTORY__CANCEL}'); ?></a>
</div>
