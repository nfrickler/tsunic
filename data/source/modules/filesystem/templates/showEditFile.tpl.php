<!-- | TEMPLATE show form to edit filesystem file -->
<?php
$File = $this->getVar('File');
?>
<div id="$$$div__showEditFsFile">
    <h1><?php $this->set('{SHOWEDITFSFILE__H1}', array('name' => $File->getInfo('name'))); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $File->getInfo('fk_directory'))); ?>">
	    <?php $this->set('{SHOWEDITFSFILE__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWEDITFSFILE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formFsFile', array(
	'File' => $File,
	'directories' => $this->getVar('directories'),
	'submit_link' => '$$$editFsFile',
	'submit_text' => '{SHOWEDITFSFILE__SUBMIT}',
	'reset_text' => '{SHOWEDITFSFILE__CANCEL}'
    )); ?>
</div>
