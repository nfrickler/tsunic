<!-- | Template: show form to delete serverbox -->
<?php

$Serverbox = $this->getVar('Serverbox');
?>
<div id="$$$div__showDeleteServerbox">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETESERVERBOX__POPUP_DELETE_HEADER}', array('name' => $Serverbox->getInfo('name')), false),
		'contenttext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETESERVERBOX__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteServerbox', array('id_mail__serverbox' => $Serverbox->getInfo('id_mail__serverbox')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
