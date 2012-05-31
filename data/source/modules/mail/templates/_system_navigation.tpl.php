<!-- | Template: show system navigation -->
<?php
$mailboxes = $this->getVar('mailboxes');
?>
<div id="$$$_div__navigation">
	<ul>
		<li id="$$$_navigation__showMailboxes">
			<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILBOXES}'); ?>
			</a>
		</li>
		<?php foreach ($mailboxes as $index => $value) { ?>
		<li id="$$$_navigation__showMailbox_<?php $this->set($value->getInfo('id')); ?>" class="$navigation__tsuniccoremodule$sub">
			<a href="<?php $this->setUrl('$$$showMailbox', array('$$$id' => $value->getInfo('id'))); ?>">
				<?php $this->set($value->getInfo('name')); ?>
			</a>
		</li>
		<?php } ?>
		<li id="$$$_navigation__showCreateMail">
			<a href="<?php $this->setUrl('$$$showCreateMail'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWCREATEMAIL}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__showMailservers">
			<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILSERVERS}'); ?>
			</a>
		</li>
		<!--
		<li id="$$$_navigation__showMailSettings">
			<a href="<?php $this->setUrl('$$$showMailsettings'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILSETTINGS}'); ?>
			</a>
		</li>
		-->
	</ul>
</div>

<script type="text/javascript">

	// add events
	document.getElementById('$$$_navigation__showMailboxes').onclick = function(){location.href='<?php $this->setUrl('$$$showMailboxes', false, false); ?>';};
	<?php foreach($this->getVar('mailboxes') as $index => $value) {
		echo 'document.getElementById("$$$_navigation__showMailbox_'.$value->getInfo('id').'").onclick = function(){location.href="'.$this->setUrl('$$$showMailbox', array('$$$id' => $value->getInfo('id')), false, false).'";};';
	} ?>
	document.getElementById('$$$_navigation__showMailservers').onclick = function(){location.href='<?php $this->setUrl('$$$showMailservers', false, false); ?>';};
	document.getElementById('$$$_navigation__showCreateMail').onclick = function(){location.href='<?php $this->setUrl('$$$showCreateMail', false, false); ?>';};
/*	document.getElementById('$$$_navigation__showMailSettings').onclick = function(){location.href='<?php $this->setUrl('$$$showMailsettings', false, false); ?>';};
*/
</script>
