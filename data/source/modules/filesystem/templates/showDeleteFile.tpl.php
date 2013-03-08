<!-- | TEMPLATE delete file? -->
<?php
$File = $this->getVar('File');
?>
<div id="$$$div__showdeleteFile">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEFILE__POPUP_DELETE_HEADER}',
	    array('name' => $File->getName()), false
	),
	'contenttext' => '{SHOWDELETEFILE__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEFILE__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEFILE__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteFile', array('$$$id' => $File->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
