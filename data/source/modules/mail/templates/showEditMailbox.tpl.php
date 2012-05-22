<!-- | Template: show form to edit mailbox -->
<?php
$mailbox = $this->getVar('mailbox');
?>
<div id="$$$div__showAddMailserver">
	<h1><?php $this->set('{SHOWEDITMAILBOX__H1}', $mailbox->getInfo('name')); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITMAILBOX__INFO}'); ?></p>
	<?php $this->display('$$$formMailbox', array('mailbox' => $mailbox,
		'submit_text' => '{SHOWEDITAILBOX__SUBMIT}',
		'reset_text' => '{SHOWEDITMAILBOX__RESET}',
		'submit_href_event' => '$$$editMailbox')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
			<?php $this->set('{SHOWEDITMAILBOX__TOSHOWMAILBOXES}'); ?></a>
	</p>
</div>
