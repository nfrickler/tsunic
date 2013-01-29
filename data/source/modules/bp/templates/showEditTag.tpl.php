<!-- | TEMPLATE show form to edit selection -->
<?php $Tag = $this->getVar('Tag'); ?>
<div id="$$$div__showEditTag">
    <h1><?php $this->set('{SHOWEDITTAG__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showEditTag__editlink" href="<?php $this->setUrl('$$$showTags'); ?>">
	    <?php $this->set('{SHOWEDITTAG__TOSHOWTAGS}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITTAG__INFOTEXT}'); ?></p>
    <?php $this->display('$$$formTag', array(
	'Tag' => $Tag,
	'submit_link' => '$$$editTag',
	'submit_text' => '{SHOWEDITTAG__SUBMIT}',
	'reset_text' => '{SHOWEDITTAG__CANCEL}'
    )); ?>

    <?php if ($Tag->getType()->getInfo('name') == 'selection' or $Tag->getType()->getInfo('name') == 'radio') { ?>
    <h2><?php $this->set('{SHOWEDITTAG__H_SELECTIONS}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateSelection', array('fk_tag' => $Tag->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITTAG__TOCREATESELECTION}'); ?></a>
    </p>
    <p><?php $this->set('{SHOWEDITTAG__SELECTIONS__INFOTEXT}'); ?></p>
    <?php $this->display('$$$showListSelections', array(
	'selections' => $Tag->getSelections(),
    )); ?>
    <?php } ?>
</div>
