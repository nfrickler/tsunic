<!-- | TEMPLATE show form to edit selection -->
<?php $Selection = $this->getVar('Selection'); ?>
<div id="$$$div__showEditSelection">
    <h1><?php $this->set('{SHOWEDITSELECTION__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showEditTag', array('$$$id' => $Selection->getInfo('fk_tag'))); ?>">
	    <?php $this->set('{SHOWEDITSELECTION__TOBACKTOTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITSELECTION__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formSelection', array(
	'Selection' => $Selection,
	'submit_link' => '$$$editSelection',
	'submit_text' => '{SHOWEDITSELECTION__SUBMIT}',
	'reset_text' => '{SHOWEDITSELECTION__CANCEL}'
    )); ?>
</div>
