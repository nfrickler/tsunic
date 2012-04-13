<!-- | TEMPLATE show system navigation -->
<div id="$$$div___navigation">
	<ul>
	<?php if ($TSunic->Usr->isLoggedIn()) { ?>
		<li id="$$$_navigation__account">
			<a href="<?php $this->setUrl('$$$showAccount'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWACCOUNT}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__config">
			<a href="<?php $this->setUrl('$$$showConfig'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWCONFIG}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__logout">
			<a href="<?php $this->setUrl('$$$doLogout'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TODOLOGOUT}'); ?>
			</a>
		</li>
	<?php } else { ?>
		<li id="$$$_navigation__showindex">
			<a href="<?php $this->setUrl('$$$showIndex'); ?>">
				<?php $this->set('{_SYSTEM_NAVIGATION__TOSHOWINDEX}'); ?>
			</a>
		</li>
	<?php } ?>
	</ul>
</div>
<script type="text/javascript">

	// add events
	<?php if ($TSunic->Usr->isLoggedIn()) { ?>
	document.getElementById('$$$_navigation__account').onclick = function(){location.href='<?php $this->setUrl('$$$showAccount', false, false); ?>';};
	document.getElementById('$$$_navigation__config').onclick = function(){location.href='<?php $this->setUrl('$$$showConfig', false, false); ?>';};
	document.getElementById('$$$_navigation__logout').onclick = function(){location.href='<?php $this->setUrl('$$$doLogout', false, false); ?>';};
	<?php } else { ?>
	document.getElementById('$$$_navigation__showindex').onclick = function(){location.href='<?php $this->setUrl('$$$showIndex', false, false); ?>';};
	<?php } ?>
</script>
