<!-- | TEMPLATE delete issue? -->
<?php
$Issue = $this->getVar('Issue');
?>
<div id="$$$div__showDeleteIssue">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEISSUE__POPUP_DELETE_HEADER}',
	    array('name' => $Issue->getName()), false
	),
	'contenttext' => '{SHOWDELETEISSUE__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEISSUE__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEISSUE__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteIssue', array('$$$id' => $Issue->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
