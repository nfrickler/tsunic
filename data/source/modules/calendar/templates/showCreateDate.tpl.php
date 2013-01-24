<!-- | TEMPLATE show form to create new date -->
<div id="$$$div__showCreateDate">
    <h1><?php $this->set('{SHOWCREATEDATE__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEDATE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formDate', array(
	'Date' => $this->getVar('Date'),
	'preset_start' => $this->getVar('preset_start'),
	'preset_stop' => $this->getVar('preset_stop'),
	'preset_repeatstop' => $this->getVar('preset_repeatstop'),
	'preset_radio' => $this->getVar('preset_radio'),
	'submit_link' => '$$$createDate',
	'submit_text' => '{SHOWCREATEDATE__SUBMIT}',
	'reset_text' => '{SHOWCREATEDATE__CANCEL}'
    )); ?>
</div>
