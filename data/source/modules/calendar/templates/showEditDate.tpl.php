<!-- | TEMPLATE show form to edit date -->
<?php $Date = $this->getVar('Date'); ?>
<div id="$$$div__showEditDate">
    <h1><?php $this->set('{SHOWEDITDATE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showEditDate__editlink" href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{SHOWEDITDATE__TOSHOWTAGS}'); ?></a>
	<a id="$$$showEditDate__toaddtag" href="<?php $this->setUrl('$bp$showAddTag', array('fk_obj' => $Date->getInfo('id'), 'backlink' => base64_encode($this->setUrl('$$$showEditDate', array('$$$id' => $Date->getInfo('id')), false, false)))); ?>">
	    <?php $this->set('{SHOWEDITDATE__TOADDTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITDATE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formDate', array(
	'Date' => $Date,
	'preset_start' => $this->getVar('preset_start'),
	'preset_stop' => $this->getVar('preset_stop'),
	'preset_repeatstop' => $this->getVar('preset_repeatstop'),
	'preset_radio' => $this->getVar('preset_radio'),
	'submit_link' => '$$$editDate',
	'submit_text' => '{SHOWEDITDATE__SUBMIT}',
	'reset_text' => '{SHOWEDITDATE__CANCEL}'
    )); ?>
</div>
