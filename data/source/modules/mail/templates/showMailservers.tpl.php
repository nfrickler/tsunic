<!-- | Template: show all mail servers -->
<div id="$$$div__showMailservers">
	<h1><?php $this->set('{SHOWMAILSERVERS__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__INFOTEXT}'); ?></p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_INFO}'); ?></p>
	<?php $this->display('$$$showListAccounts', array('mailaccounts' => $this->getVar('mailaccounts'))); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddAccount'); ?>">
			<?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_ADD}'); ?></a>
	</p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWMAILSERVERS__SMTPS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__SMTPS_INFO}'); ?></p>
	<?php $this->display('$$$showListSmtps', array('smtps' => $this->getVar('smtps'))); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddSmtp'); ?>">
			<?php $this->set('{SHOWMAILSERVERS__SMTPS_ADD}'); ?></a>
	</p>
</div>
