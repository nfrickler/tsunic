<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<a href="<?php $this->setUrl('$$$showDay'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWDAY}'); ?></a>
	<a href="<?php $this->setUrl('$$$showMonth'); ?>">
	    <?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWMONTH}'); ?></a>
    <?php } ?>
</div>
