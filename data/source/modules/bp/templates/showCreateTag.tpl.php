<!-- | TEMPLATE show form to create new tag -->
<div id="$$$div__showCreateTag">
    <h1><?php $this->set('{SHOWCREATETAG__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATETAG__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formTag', array(
	'Tag' => $this->getVar('Tag'),
	'submit_link' => '$$$createTag',
	'submit_text' => '{SHOWCREATETAG__SUBMIT}',
	'reset_text' => '{SHOWCREATETAG__CANCEL}'
    )); ?>
</div>
