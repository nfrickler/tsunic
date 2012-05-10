<!-- | TEMPLATE delete file? -->
<?php
$File = $this->getVar('File');
?>
<div id="$$$div__showdeleteFsFile">
	<h1><?php $this->set('{SHOWDELETEFSFILE__H1}',
		array('name' => $File->getInfo('name'))
	); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWDELETEFSFILE__INFOTEXT}'); ?>
	</p>
	<a style="ts_submit" href="<?php $this->setUrl('$$$deleteFsFile', array('$$$id' => $File->getInfo('id'))); ?>">
		<?php $this->set('{SHOWDELETEFSFILE__SUBMIT}'); ?></a>
	<a style="ts_cancel" href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $File->getInfo('fk_directory'))); ?>">
		<?php $this->set('{SHOWDELETEFSFILE__CANCEL}'); ?></a>
</div>
