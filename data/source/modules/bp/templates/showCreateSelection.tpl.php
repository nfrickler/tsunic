<!-- | TEMPLATE show form to create new selection -->
<div id="$$$div__showCreateSelection">
    <h1><?php $this->set('{SHOWCREATESELECTION__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showEditTag', array('$$$id' => $this->getVar('fk_tag'))); ?>">
	    <?php $this->set('{SHOWCREATESELECTION__TOBACKTOTAG}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATESELECTION__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formSelection', array(
	'Selection' => $this->getVar('Selection'),
	'fk_tag' => $this->getVar('fk_tag'),
	'submit_link' => '$$$createSelection',
	'submit_text' => '{SHOWCREATESELECTION__SUBMIT}',
	'reset_text' => '{SHOWCREATESELECTION__CANCEL}'
    )); ?>
</div>
