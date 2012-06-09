<!-- | TEMPLATE confirm deletion of mail -->
<?php
$Mail = $this->getVar('Mail');
?>
<div id="$$$div__showDeleteMail">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEMAIL__POPUP_DELETE_HEADER}', array('name' => $Mail->getInfo('subject')), false),
	'contenttext' => '{SHOWDELETEMAIL__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEMAIL__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEMAIL__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteMail', array('$$$id' => $Mail->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
