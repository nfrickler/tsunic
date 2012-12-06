<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showProfile'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWPROFILE}'); ?></a>
	<a href="<?php $this->setUrl('$$$showEditProfile'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWEDITPROFILE}'); ?></a>
    <?php } ?>
</div>
