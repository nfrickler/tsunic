<!-- | TEMPLATE delete directory? -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showdeleteDirectory">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEDIRECTORY__POPUP_DELETE_HEADER}',
	    array('name' => $Dir->getName()), false
	),
	'contenttext' => '{SHOWDELETEDIRECTORY__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEDIRECTORY__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEDIRECTORY__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteDirectory', array('$$$id' => $Dir->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
