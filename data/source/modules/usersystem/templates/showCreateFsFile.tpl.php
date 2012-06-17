<!-- | TEMPLATE show form to create new filesystem file -->
<div id="$$$div__showCreateFsFile">
    <h1><?php $this->set('{SHOWCREATEFSFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $this->getVar('fk_directory'))); ?>">
	    <?php $this->set('{SHOWCREATEFSFILE__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEFSFILE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formFsFile', array(
	'File' => $this->getVar('File'),
	'directories' => $this->getVar('directories'),
	'fk_parent' => $this->getVar('fk_directory'),
	'submit_link' => '$$$createFsFile',
	'submit_text' => '{SHOWCREATEFSFILE__SUBMIT}',
	'reset_text' => '{SHOWCREATEFSFILE__CANCEL}'
    )); ?>
</div>
