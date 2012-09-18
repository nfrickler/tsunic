<!-- | TEMPLATE show system navigation -->
<?php
$mailboxes = $this->getVar('mailboxes');
?>

<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
    <?php $this->set('{_NAVIGATION__SHOWMAILBOXES}'); ?></a>

<?php foreach ($mailboxes as $index => $value) { ?>
    <a href="<?php $this->setUrl('$$$showMailbox', array('$$$id' => $value->getInfo('id'))); ?>" class="$navigation$sub">
	<?php $this->set($value->getInfo('name')); ?></a>
<?php } ?>

<a href="<?php $this->setUrl('$$$showCreateMail'); ?>">
    <?php $this->set('{_NAVIGATION__SHOWCREATEMAIL}'); ?></a>
<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
    <?php $this->set('{_NAVIGATION__SHOWMAILSERVERS}'); ?></a>
<!--
<a href="<?php $this->setUrl('$$$showMailsettings'); ?>">
    <?php $this->set('{_NAVIGATION__SHOWMAILSETTINGS}'); ?></a>
-->
