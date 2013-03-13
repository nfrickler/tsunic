<!-- | TEMPLATE delete queue? -->
<?php
$Queue = $this->getVar('Queue');
?>
<div id="$$$div__showDeleteQueue">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEQUEUE__POPUP_DELETE_HEADER}',
	    array('name' => $Queue->getName()), false
	),
	'contenttext' => '{SHOWDELETEQUEUE__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEQUEUE__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEQUEUE__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteQueue', array('$$$id' => $Queue->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
