<!-- | TEMPLATE show form to choose object -->
<div id="$$$div__showChooseObject">
    <h1><?php $this->set($this->getVar('headline')); ?></h1>
    <p class="ts_infotext">
	<?php $this->set($this->getVar('infotext')); ?>
    </p>

    <?php $this->display('$$$formChooseObject', array(
	'objects' => $this->getVar('objects'),
	'fk_bit' => $this->getVar('fk_bit'),
	'backlink' => $this->getVar('backlink'),
	'submit_link' => '$$$chooseObject',
	'submit_text' => '{SHOWCHOOSEOBJECT__SUBMIT}',
	'reset_text' => '{SHOWCHOOSEOBJECT__CANCEL}'
    )); ?>
</div>
