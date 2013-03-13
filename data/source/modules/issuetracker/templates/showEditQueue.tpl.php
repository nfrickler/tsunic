<!-- | TEMPLATE show form to edit queue -->
<?php $Queue = $this->getVar('Queue'); ?>
<div id="$$$div__showEditQueue">
    <h1><?php $this->set('{SHOWEDITQUEUE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showQueue', array('$$$id' => $Queue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITQUEUE__TOSHOWQUEUE}'); ?></a>
	<a href="<?php $this->setUrl('$bp$showAddTag', array('fk_obj' => $Queue->getInfo('id'), 'backlink' => base64_encode($this->setUrl('$$$showEditQueue', array('$$$id' => $Queue->getInfo('id')), false, false)))); ?>">
	    <?php $this->set('{SHOWEDITQUEUE__TOADDTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITQUEUE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formQueue', array(
	'Queue' => $Queue,
	'submit_link' => '$$$editQueue',
	'submit_text' => '{SHOWEDITQUEUE__SUBMIT}',
	'reset_text' => '{SHOWEDITQUEUE__CANCEL}'
    )); ?>
</div>
