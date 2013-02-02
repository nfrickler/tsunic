<!-- | TEMPLATE show form to edit filesystem file -->
<?php
$File = $this->getVar('File');
?>
<div id="$$$div__showEditFile">
    <h1><?php $this->set('{SHOWEDITFILE__H1}', array('name' => $File->getInfo('name'))); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showIndex', array('$$$id' => $File->getInfo('parent'))); ?>">
	    <?php $this->set('{SHOWEDITFILE__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWEDITFILE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formFile', array(
	'File' => $File,
	'showUpload' => false,
	'submit_link' => '$$$editFile',
	'submit_text' => '{SHOWEDITFILE__SUBMIT}',
	'reset_text' => '{SHOWEDITFILE__CANCEL}'
    )); ?>
</div>
