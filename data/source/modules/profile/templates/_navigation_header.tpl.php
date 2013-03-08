<!-- | TEMPLATE show header navigation -->
<?php if ($TSunic->Usr->access('$$$useProfiles')) { ?>
<a href="<?php $this->setUrl('$$$showIndex'); ?>">
    <?php $this->set('{_HEADER_NAVIGATION__SHOWPROFILE}'); ?></a>
<?php } else { ?>
<a href="<?php $this->setUrl('$$$showMyProfile'); ?>">
    <?php $this->set('{_HEADER_NAVIGATION__SHOWMYPROFILE}'); ?></a>
<?php } ?>
