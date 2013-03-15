<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showMyProfile'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWMYPROFILE}'); ?></a>
	<?php if ($TSunic->Usr->access('$$$showMyProfiles')) { ?>
	<a href="<?php $this->setUrl('$$$showMyProfiles'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWMYPROFILES}'); ?></a>
	<?php } ?>
	<?php if ($TSunic->Usr->access('$$$useProfiles')) { ?>
	<a href="<?php $this->setUrl('$$$showProfiles'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWPROFILES}'); ?></a>
	<a href="<?php $this->setUrl('$bp$showTags'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWTAGS}'); ?></a>
	<?php } ?>
    <?php } ?>
</div>
