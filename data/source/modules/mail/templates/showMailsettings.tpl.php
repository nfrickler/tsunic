<!-- | Template: show mail settings -->
<?php

// get input
$mailsettings = $this->getVar('mailserver');
?>
<div id="$$$div__showmailsettings">
	<h1><?php $this->set('{SHOWMAILSETTINGS_H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITMAILSERVER_INFO}'); ?></p>
	<?php $this->display('$$$formMailserver', array('mailserver' => $mailserver,
		'mailboxes' => $this->getVar('mailboxes'),
		'submit_text' => 'MAIL_SHOWEDITAILSERVER_SUBMIT}',
		'reset_text' => 'MAIL_SHOWEDITMAILSERVER_RESET}',
		'submit_href_event' => 'editMailserver')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
			<?php $this->set('{SHOWEDITMAILSERVER_GOTO_SHOWMAILSERVERS}'); ?></a>
	</p>
</div>
