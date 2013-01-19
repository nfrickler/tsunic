<!-- | TEMPLATE show form to edit date -->
<?php $Date = $this->getVar('Date'); ?>
<div id="$$$div__showEditDate">
    <h1><?php $this->set('{SHOWEDITDATE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showEditDate__editlink" href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{SHOWEDITDATE__TOSHOWTAGS}'); ?></a>
	<a id="$$$showEditDate__toaddtag" href="<?php $this->setUrl('$$$showAddTag', array('fk_obj' => $Date->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITDATE__TOADDTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITDATE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formDate', array(
	'Date' => $Date,
	'submit_link' => '$$$editDate',
	'submit_text' => '{SHOWEDITDATE__SUBMIT}',
	'reset_text' => '{SHOWEDITDATE__CANCEL}'
    )); ?>
</div>
