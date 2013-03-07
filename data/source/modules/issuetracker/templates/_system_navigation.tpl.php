<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showIndex'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWINDEX}'); ?></a>
	<a href="<?php $this->setUrl('$$$showCreateIssue'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWCREATEISSUE}'); ?></a>
    <?php } ?>
</div>
