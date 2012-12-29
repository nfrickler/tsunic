<!-- | TEMPLATE delete tag? -->
<?php $Tag = $this->getVar('Tag'); ?>
<div id="$$$div__showDeleteTag">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETETAG__POPUP_DELETE_HEADER}',
	    array('name' => $Tag->getInfo('name')), false
	),
	'contenttext' => '{SHOWDELETETAG__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETETAG__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETETAG__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteTag', array('$$$id' => $Tag->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
