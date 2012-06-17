<!-- | TEMPLATE delete user? -->
<?php
$User = $this->getVar('User');
?>
<div id="$$$div__showdeleteUser">
    <h1><?php $this->set('{SHOWDELETEUSER__H1}',
	array('name' => $User->getInfo('name'), 'email' => $User->getInfo('email'))
    ); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWDELETEUSER__INFOTEXT}'); ?>
    </p>
    <a style="ts_submit" href="<?php $this->setUrl('$$$deleteUser', array('$$$id' => $User->getInfo('id'))); ?>">
	<?php $this->set('{SHOWDELETEUSER__OK}'); ?></a>
    <a style="ts_cancel" href="<?php $this->setUrl('$$$showUserlist'); ?>">
	<?php $this->set('{SHOWDELETEUSER__CANCEL}'); ?></a>
</div>
