<!-- | TEMPLATE show form to create new filesystem file -->
<div id="$$$div__showCreateFile">
    <h1><?php $this->set('{SHOWCREATEFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showIndex', array('$$$id' => $this->getVar('fk_directory'))); ?>">
	    <?php $this->set('{SHOWCREATEFILE__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEFILE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formFile', array(
	'File' => $this->getVar('File'),
	'showUpload' => true,
	'fk_directory' => $this->getVar('fk_directory'),
	'submit_link' => '$$$createFile',
	'submit_text' => '{SHOWCREATEFILE__SUBMIT}',
	'reset_text' => '{SHOWCREATEFILE__CANCEL}'
    )); ?>
</div>
