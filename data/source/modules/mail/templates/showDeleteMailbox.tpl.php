<!-- | -->
<?php

$mailbox = $this->getVar('mailbox');
?>
<div id="div_mail__showDeleteMailbox">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETEMAILBOX__POPUP_DELETE_HEADER}', array('name' => $mailbox->getInfo('name')), false),
		'contenttext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETEMAILBOX__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteMailbox', array('id_mail__box' => $mailbox->getInfo('id_mail__box')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
