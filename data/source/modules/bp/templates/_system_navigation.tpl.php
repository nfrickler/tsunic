<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showTags'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWTAGS}'); ?></a>
    <?php } ?>
</div>
