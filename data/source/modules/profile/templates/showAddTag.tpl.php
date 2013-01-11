<!-- | TEMPLATE show form to add tag to profile -->
<div id="$$$div__showAddTag">
    <h1><?php $this->set('{SHOWADDTAG__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWADDTAG__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formAddTag', array(
	'tags' => $this->getVar('tags'),
	'fk_obj' => $this->getVar('fk_obj'),
	'submit_link' => '$$$addTag',
	'submit_text' => '{SHOWADDTAG__SUBMIT}',
	'reset_text' => '{SHOWADDTAG__CANCEL}'
    )); ?>
</div>
