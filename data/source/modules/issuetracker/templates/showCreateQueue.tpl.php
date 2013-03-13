<!-- | TEMPLATE show form to create new queue -->
<div id="$$$div__showCreateQueue">
    <h1><?php $this->set('{SHOWCREATEQUEUE__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEQUEUE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formQueue', array(
	'Queue' => $this->getVar('Queue'),
	'submit_link' => '$$$createQueue',
	'submit_text' => '{SHOWCREATEQUEUE__SUBMIT}',
	'reset_text' => '{SHOWCREATEQUEUE__CANCEL}'
    )); ?>
</div>
