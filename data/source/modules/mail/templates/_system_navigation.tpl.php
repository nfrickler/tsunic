<!-- | -->
<?php

// get input
$mailboxes = $this->getVar('mailboxes');
?>
<div id="$$$_div__navigation">
	<ul>
		<li id="$$$_navigation__showMailBoxes">
			<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILBOXES}'); ?>
			</a>
		</li>
		<?php foreach ($mailboxes as $index => $value) { ?>
		<li id="$$$_navigation__showMailbox_<?php $this->set($value->getInfo('id_mail__box')); ?>" class="$navigation__tsuniccoremodule$sub">
			<a href="<?php $this->setUrl('$$$showMailbox', array('id_mail__box' => $value->getInfo('id_mail__box'))); ?>">
				<?php $this->set($value->getInfo('name')); ?>
			</a>
		</li>
		<?php } ?>
		<li id="$$$_navigation__showSendMail">
			<a href="<?php $this->setUrl('$$$showSendMail'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWSENDMAIL}'); ?>
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
	document.getElementById('$$$_navigation__showMailBoxes').onclick = function(){location.href='<?php $this->setUrl('$$$showMailboxes', false, false); ?>';};
	<?php foreach($this->getVar('mailboxes') as $index => $value) {
		echo 'document.getElementById("$$$_navigation__showMailbox_'.$value->getInfo('id_mail__box').'").onclick = function(){location.href="'.$this->setUrl('$$$showMailbox', array('id_mail__box' => $value->getInfo('id_mail__box')), false, false).'";};';
	} ?>
	document.getElementById('$$$_navigation__showMailservers').onclick = function(){location.href='<?php $this->setUrl('$$$showMailservers', false, false); ?>';};
	document.getElementById('$$$_navigation__showSendMail').onclick = function(){location.href='<?php $this->setUrl('$$$showSendMail', false, false); ?>';};
/*	document.getElementById('$$$_navigation__showMailSettings').onclick = function(){location.href='<?php $this->setUrl('$$$showMailsettings', false, false); ?>';};
*/
</script>
