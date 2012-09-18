<!-- | TEMPLATE header-navigation -->
<div id="$$$div__navigation_header">
    <?php $this->displaySub('left'); ?>
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<?php $this->displaySub('left_on'); ?>
	<a href="<?php $this->setUrl('$system$showMain'); ?>">
	    <?php $this->set('{NAVIGATION_HEADER__SYSTEM}'); ?></a>
    <?php } else { ?>
	<?php $this->displaySub('left_off'); ?>
	<a href="<?php $this->setUrl('$usersystem$showIndex'); ?>">
	    <?php $this->set('{NAVIGATION_HEADER__TOSHOWINDEX}'); ?></a>
    <?php } ?>
    <?php if ($TSunic->Usr->isLoggedIn()) { ?>
	<?php $this->displaySub('right_on'); ?>
    <?php } else { ?>
	    <?php $this->displaySub('right_off'); ?>
    <?php } ?>
    <?php $this->displaySub('right'); ?>
</div>
