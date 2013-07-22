<!-- | TEMPLATE show form to link an object -->
<div id="$$$div__showLinkObject">
    <h1><?php $this->set($this->getVar('headline')); ?></h1>
    <p class="ts_infotext">
	<?php $this->set($this->getVar('infotext')); ?>
    </p>

    <?php $this->display('$$$formLinkObject', array(
	'fk_obj' => $this->getVar('fk_obj'),
	'objects' => $this->getVar('objects'),
	'backlink' => $this->getVar('backlink'),
	'submit_link' => '$$$linkObject',
	'submit_text' => '{SHOWLINKOBJECT__SUBMIT}',
	'reset_text' => '{SHOWLINKOBJECT__CANCEL}'
    )); ?>
</div>
