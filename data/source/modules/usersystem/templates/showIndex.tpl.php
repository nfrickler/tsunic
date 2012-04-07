<!-- | TEMPLATE show index page -->
<div id="$$$div__showIndex">
	<h1><?php echo $this->set('{SHOWINDEX__H1}'); ?></h1>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__INFOTEXT}'); ?></p>
	<h2><?php echo $this->set('{SHOWINDEX__LOGIN_H1}'); ?></h2>
	<?php $this->display('$$$formLogin'); ?>
	<h2><?php echo $this->set('{SHOWINDEX__REGISTER_H1}'); ?></h2>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__REGISTER_INFOTEXT}'); ?></p>
	<?php $this->display('$$$formRegistration'); ?>
	<h2><?php echo $this->set('{SHOWINDEX__RESET_H1}'); ?></h2>
	<p class="ts_infotext"><?php echo $this->set('{SHOWINDEX__RESET_INFOTEXT}'); ?></p>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$system$resetAllCookies'); ?>">
			<?php echo $this->set('{SHOWINDEX__REGISTER_LINK}'); ?></a>
	</p>
</div>
