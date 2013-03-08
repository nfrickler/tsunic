<!-- | TEMPLATE delete profile? -->
<?php
$Profile = $this->getVar('Profile');
?>
<div id="$$$div__showDeleteProfile">
    <?php $this->display('$system$showOptionbox', array(
	'headertext' => $this->set('{SHOWDELETEPROFILE__POPUP_DELETE_HEADER}',
	    array('name' => $Profile->getName()), false
	),
	'contenttext' => '{SHOWDELETEPROFILE__POPUP_DELETE_CONTENT}',
	'submittext' => '{SHOWDELETEPROFILE__POPUP_DELETE_YES}',
	'canceltext' => '{SHOWDELETEPROFILE__POPUP_DELETE_NO}',
	'submit_href' => $this->setUrl('$$$deleteProfile', array('$$$id' => $Profile->getInfo('id')), true, false),
	'cancel_href' => $this->setUrl('back', true, true, false)
    )); ?>
</div>
