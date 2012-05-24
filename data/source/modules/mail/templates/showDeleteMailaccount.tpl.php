<!-- | Template: show form to delete mail account -->
<?php
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="$$$div__showDeleteMailaccount">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETEACCOUNT__POPUP_DELETE_HEADER}', array('name' => $Mailaccount->getInfo('name')), false),
		'contenttext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteMailaccount', array('$$$id' => $Mailaccount->getInfo('id')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
