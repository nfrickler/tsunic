<!-- | -->
<?php

// get input
$Account = $this->getVar('Account');
?>
<div id="$$$div__showDeleteAccount">
	<?php $this->display('$system$showOptionbox', array('headertext' => $this->set('{SHOWDELETEACCOUNT__POPUP_DELETE_HEADER}', array('name' => $Account->getInfo('name')), false),
		'contenttext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_CONTENT}',
		'submittext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_YES}',
		'canceltext' => '{SHOWDELETEACCOUNT__POPUP_DELETE_NO}',
		'submit_href' => $this->setUrl('$$$deleteAccount', array('id_mail__account' => $Account->getInfo('id_mail__account')), true, false),
		'cancel_href' => $this->setUrl('back', true, true, false))); ?>
</div>
