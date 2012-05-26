<!-- | Template: show form to delete mail account -->
<?php
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="$$$div__showDeleteMailaccount">
	<?php $this->display('$system$showOptionbox', array(
		'headertext' => $this->set('{SHOWDELETEMAILACCOUNT__POPUP_DELETE_HEADER}', array('name' => $Mailaccount->getInfo('name')), false),
		'contenttext' => '{SHOWDELETEMAILACCOUNT__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETEMAILACCOUNT__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETEMAILACCOUNT__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteMailaccount', array('$$$id' => $Mailaccount->getInfo('id')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false)
	)); ?>
</div>
