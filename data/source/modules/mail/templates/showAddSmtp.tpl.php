<!-- | Template: show form to add new SMTP -->
<div id="$$$div__showAddSmtp">
	<h1><?php $this->set('{SHOWADDSMTP__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWADDSMTP__INFO}'); ?></p>
	<?php $this->display('$$$formSmtp', array(
		'Smtp' => $this->getVar('Smtp'),
		'mailaccounts' => $this->getVar('mailaccounts'),
		'submit_text' => '{SHOWADDSMTP__SUBMIT}',
		'reset_text' => '{SHOWADDSMTP__RESET}',
		'submit_href_event' => '$$$addSmtp'
	)); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('back'); ?>">
			<?php $this->set('{SHOWADDSMTP__OVERVIEW}'); ?></a>
	</p>
</div>
