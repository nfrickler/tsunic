<!-- | TEMPLATE - show header -->
<div id="$$$div__header">
	<div id="$$$div__header__logodiv">
		<img src="<?php $this->setImg('project', '$$$tsunic4_logo.png'); ?>" alt="logo TSunic 4.0" style="height:80px; margin-top:2px; float:left; margin-right:10px;" />
		<h1 style="padding-top:10px; padding-left:10px;"><?php $this->set('TSunic '.$TSunic->Config->getConfig('version')); ?></h1>
		<p style="padding-left:10px;"><?php echo $this->set('Manage your life - the easy way!'); ?></p>
		<div style="clear:both;"></div>
	</div>
	<?php $this->display('$usersystem$userheader'); ?>
</div>
