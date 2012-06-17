<!-- | TEMPLATE show login -->
<div id="$$$div__showLogin">
    <h1><?php echo $this->set('{SHOWLOGIN__H1}'); ?></h1>
    <p class="ts_infotext">
	<?php echo $this->set('{SHOWLOGIN__INFOTEXT}'); ?>
    </p>
    <?php $this->display('$$$formLogin'); ?>
    <h2><?php echo $this->set('{SHOWLOGIN__RESET_H1}'); ?></h2>
    <p class="ts_infotext"><?php echo $this->set('{SHOWLOGIN__RESET_INFOTEXT}'); ?></p>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('$system$resetAllCookies'); ?>">
	    <?php echo $this->set('{SHOWLOGIN__RESET_LINK}'); ?></a>
    </p>
</div>
