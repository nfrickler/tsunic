<!-- | TEMPLATE show index page -->
<div id="$$$div__showIndex">
    <h1><?php $this->set('{SHOWINDEX__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWINDEX__INFOTEXT}'); ?></p>
    <h2><?php $this->set('{SHOWINDEX__LOGIN_H1}'); ?></h2>
    <?php $this->display('$$$formLogin'); ?>
    <h2><?php $this->set('{SHOWINDEX__REGISTER_H1}'); ?></h2>
    <p class="ts_infotext"><?php $this->set('{SHOWINDEX__REGISTER_INFOTEXT}'); ?></p>
    <?php $this->display('$$$formAccount', array(
	'User' => $this->getVar('User'),
	'submit_link' => '$$$doRegister',
	'submit_text' => '{SHOWREGISTRATION__SUBMIT}',
	'password_required' => true
    )); ?>
    <h2><?php $this->set('{SHOWINDEX__RESET_H1}'); ?></h2>
    <p class="ts_infotext"><?php $this->set('{SHOWINDEX__RESET_INFOTEXT}'); ?></p>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('$system$resetAllCookies'); ?>">
	    <?php $this->set('{SHOWINDEX__REGISTER_LINK}'); ?></a>
    </p>
</div>
