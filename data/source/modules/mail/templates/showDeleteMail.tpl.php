<!-- | -->
<?php

$mail = $this->getVar('mail');
?>
<div id="$$$div__showDeleteMail">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETE{POPUP_DELETE_HEADER}', array('name' => $mail->getInfo('subject')), false),
		'contenttext' => '{SHOWDELETE{POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETE{POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETE{POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteMail', array('id_mail__mail' => $mail->getInfo('id_mail__mail')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
