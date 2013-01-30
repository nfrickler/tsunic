<!-- | TEMPLATE delete object? -->
<?php $Object = $this->getVar('Object'); ?>
<div id="$$$div__showDeleteObject">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEOBJECT__POPUP_DELETE_HEADER}',
	    array('name' => $Object->getInfo('name')), false
	),
	'contenttext' => '{SHOWDELETEOBJECT__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEOBJECT__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEOBJECT__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteObject', array('$$$id' => $Object->getInfo('id'), '$$$backlink' => $this->getVar('backlink')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
