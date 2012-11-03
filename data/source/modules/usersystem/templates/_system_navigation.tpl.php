<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showAccount'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWACCOUNT}'); ?></a>
	<a href="<?php $this->setUrl('$$$showConfig'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWCONFIG}'); ?></a>
	<a href="<?php $this->setUrl('$$$showFsDirectory'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWFILESYSTEM}'); ?></a>
	<?php if ($TSunic->Usr->access('$$$seeOwnAccess')) { ?>
	<a href="<?php $this->setUrl('$$$showAccess'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWACCESS}'); ?></a>
	<?php } ?>
	<?php if ($TSunic->Usr->access('$$$listAllUsers')) { ?>
	<a href="<?php $this->setUrl('$$$showUserlist'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWUSERLIST}'); ?></a>
	<?php } ?>
    <?php } else { ?>
	<a href="<?php $this->setUrl('$$$showIndex'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWINDEX}'); ?>
    <?php } ?>
</div>
