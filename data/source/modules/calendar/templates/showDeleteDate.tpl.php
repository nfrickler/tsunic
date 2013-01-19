<!-- | TEMPLATE delete date? -->
<?php
$Date = $this->getVar('Date');
?>
<div id="$$$div__showDeleteDate">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEDATE__POPUP_DELETE_HEADER}',
	    array('name' => $Date->getInfo('firstname')." ".
	    $Date->getInfo('lastname')), false
	),
	'contenttext' => '{SHOWDELETEDATE__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEDATE__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEDATE__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteDate', array('$$$id' => $Date->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
