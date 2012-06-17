<!-- | TEMPLATE show userheader -->
<div id="$$$div__userheader">
    <?php if (!$TSunic->Usr->isLoggedIn()) { ?>
    <p id="$$$div__userheader__topright">
	<?php $this->set('{USERHEADER__NOTLOGGEDIN}'); ?>
    </p>
    <?php } else { ?>
    <p id="$$$div__userheader__topright">
	<?php $this->set('{USERHEADER__LOGGEDINAS}', array('name' => $TSunic->Usr->getInfo('name'))); ?>
	| <a href="<?php $this->setUrl('$usersystem$doLogout'); ?>">
	    <?php $this->set('{USERHEADER__LOGOUT}'); ?>
	</a>
    </p>
    <img src="<?php $this->setImg('project', '$$$unknown_user_small.png'); ?>" id="$$$div__userheader__image" />
    <?php } ?>
</div>
