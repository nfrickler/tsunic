<!-- | TEMPLATE delete selection? -->
<?php $Selection = $this->getVar('Selection'); ?>
<div id="$$$div__showDeleteSelection">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETESELECTION__POPUP_DELETE_HEADER}',
	    array('name' => $Selection->getInfo('firstname')), false
	),
	'contenttext' => '{SHOWDELETESELECTION__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETESELECTION__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETESELECTION__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteSelection', array('$$$id' => $Selection->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
