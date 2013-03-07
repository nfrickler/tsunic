<!-- | TEMPLATE show form to edit issue -->
<?php $Issue = $this->getVar('Issue'); ?>
<div id="$$$div__showEditIssue">
    <h1><?php $this->set('{SHOWEDITISSUE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showIssue', array('$$$id' => $Issue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITISSUE__TOSHOWISSUE}'); ?></a>
	<a href="<?php $this->setUrl('$bp$showAddTag', array('fk_obj' => $Issue->getInfo('id'), 'backlink' => base64_encode($this->setUrl('$$$showEditIssue', array('$$$id' => $Issue->getInfo('id')), false, false)))); ?>">
	    <?php $this->set('{SHOWEDITISSUE__TOADDTAG}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITISSUE__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formIssue', array(
	'Issue' => $Issue,
	'submit_link' => '$$$editIssue',
	'submit_text' => '{SHOWEDITISSUE__SUBMIT}',
	'reset_text' => '{SHOWEDITISSUE__CANCEL}'
    )); ?>
</div>
