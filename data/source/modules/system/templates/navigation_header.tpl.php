<!-- | TEMPLATE - header-navigation -->
<div id="$$$div__navigation_header">
	<ul style="float:left;">
		<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
			<?php $this->displaySub('left_on'); ?>
		<?php } else { ?>
			<?php $this->displaySub('left_off'); ?>
		<?php } ?>
		<?php $this->displaySub('left'); ?>
	</ul>
	<ul style="float:right;">
		<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
			<?php $this->displaySub('right_on'); ?>

		<li id="$$$navigation_header__system" class="$$$navigation_header_important">
			<a href="<?php $this->setUrl('$system$showMain'); ?>">
				<?php $this->set('{NAVIGATION_HEADER__SYSTEM}'); ?>
			</a>
		</li>
		<?php } else { ?>
		<?php $this->displaySub('right_off'); ?>
		<li id="$$$navigation_header__showIndex" class="$$$navigation_header_important">
			<a href="<?php $this->setUrl('$usersystem$showIndex'); ?>">
				<?php $this->set('{NAVIGATION_HEADER__TOSHOWINDEX}'); ?>
			</a>
		</li>
		<?php } ?>
		<?php $this->displaySub('right'); ?>
	</ul>
	<div style="clear:both;"></div>
</div>
<script type="text/javascript">

	// add events
	<?php if (!$TSunic->CurrentUser->isGuest()) { ?>
	document.getElementById('$$$navigation_header__system').onclick = function(){location.href='<?php $this->setUrl('$$$showMain', false, false); ?>';};
	<?php } else { ?>
	document.getElementById('$$$navigation_header__showIndex').onclick = function(){location.href='<?php $this->setUrl('$usersystem$showIndex', false, false); ?>';};
	<?php } ?>

</script>
