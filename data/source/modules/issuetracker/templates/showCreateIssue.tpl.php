<!-- | TEMPLATE show form to create new issue -->
<div id="$$$div__showCreateIssue">
    <h1><?php $this->set('{SHOWCREATEISSUE__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEISSUE__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formIssue', array(
	'Issue' => $this->getVar('Issue'),
	'submit_link' => '$$$createIssue',
	'submit_text' => '{SHOWCREATEISSUE__SUBMIT}',
	'reset_text' => '{SHOWCREATEISSUE__CANCEL}'
    )); ?>
</div>
