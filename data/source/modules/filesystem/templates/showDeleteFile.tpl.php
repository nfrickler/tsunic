<!-- | TEMPLATE delete file? -->
<?php
$File = $this->getVar('File');
?>
<div id="$$$div__showdeleteFile">
    <h1><?php $this->set('{SHOWDELETEFILE__H1}',
	//array('name' => $File->getInfo('name'))
	array('name' => $File->getName())
    ); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWDELETEFILE__INFOTEXT}'); ?>
    </p>
    <a style="ts_submit" href="<?php $this->setUrl('$$$deleteFile', array('$$$id' => $File->getInfo('id'))); ?>">
	<?php $this->set('{SHOWDELETEFILE__SUBMIT}'); ?></a>
    <a style="ts_cancel" href="<?php $this->setUrl('$$$showIndex', array('$$$id' => $File->getInfo('parent'))); ?>">
	<?php $this->set('{SHOWDELETEFILE__CANCEL}'); ?></a>
</div>
