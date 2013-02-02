<!-- | TEMPLATE delete directory? -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showdeleteDirectory">
    <h1><?php $this->set('{SHOWDELETEDIRECTORY__H1}',
	array('name' => $Dir->getInfo('name'))
    ); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWDELETEDIRECTORY__INFOTEXT}'); ?>
    </p>
    <a style="ts_submit" href="<?php $this->setUrl('$$$deleteDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
	<?php $this->set('{SHOWDELETEDIRECTORY__SUBMIT}'); ?></a>
    <a style="ts_cancel" href="<?php $this->setUrl('$$$showDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
	<?php $this->set('{SHOWDELETEDIRECTORY__CANCEL}'); ?></a>
</div>
