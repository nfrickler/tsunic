<!-- | TEMPLATE show form to edit selection -->
<?php $Tag = $this->getVar('Tag'); ?>
<div id="$$$div__showEditTag">
    <h1><?php $this->set('{SHOWEDITTAG__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITTAG__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formTag', array(
	'Tag' => $Tag,
	'submit_link' => '$$$editTag',
	'submit_text' => '{SHOWEDITTAG__SUBMIT}',
	'reset_text' => '{SHOWEDITTAG__CANCEL}'
    )); ?>
</div>
