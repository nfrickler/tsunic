<!-- | Template: show form to add new mailbox -->
<div id="$$$div__showAddMailbox">
	<h1><?php $this->set('{SHOWADDMAILBOX__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWADDMAILBOX__INFO}'); ?></p>
	<?php $this->display('$$$formMailbox', array('mailbox' => $this->getVar('mailbox'),
				'submit_text' => '{SHOWADDMAILBOX__SUBMIT}',
				'reset_text' => '{SHOWADDMAILBOX__RESET}',
				'submit_href_event' => '$$$addMailbox')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
			<?php $this->set('{SHOWADDMAILBOX__TOSHOWMAILBOXES}'); ?></a>
	</p>
</div>
