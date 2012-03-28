<!-- | -->
<?php

$Smtp = $this->getVar('Smtp');
?>
<div id="$$$div__showDeleteSmtp">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETESMTP__POPUP_DELETE_HEADER}', array('name' => $Smtp->getInfo('name')), false),
		'contenttext' => '{SHOWDELETESMTP__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETESMTP__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETESMTP__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteSmtp', array('id_mail__smtp' => $Smtp->getInfo('id_mail__smtp')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
