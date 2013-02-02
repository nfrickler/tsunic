<!-- | TEMPLATE show form to create new filesystem directory -->
<div id="$$$div__showCreateDirectory">
    <h1><?php $this->set('{SHOWCREATEDIRECTORY__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showIndex', array('$$$id' => $this->getVar('parent_preset'))); ?>">
	    <?php $this->set('{SHOWCREATEDIRECTORY__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEDIRECTORY__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formDirectory', array(
	'Directory' => $this->getVar('Directory'),
	'parent_preset' => $this->getVar('parent_preset'),
	'showParent' => false,
	'submit_link' => '$$$createDirectory',
	'submit_text' => '{SHOWCREATEDIRECTORY__SUBMIT}',
	'reset_text' => '{SHOWCREATEDIRECTORY__CANCEL}'
    )); ?>
</div>
