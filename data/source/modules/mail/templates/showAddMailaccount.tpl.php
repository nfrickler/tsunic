<!-- | Template: show form to add account -->
<div id="$$$div__showAddMailaccount">
	<h1><?php $this->set('{SHOWADDMAILACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWADDMAILACCOUNT__INFO}'); ?></p>

	<?php $this->display(
		'$$$formMailaccount',
		array('Mailaccount' => $this->getVar('Mailaccount'),
			'submit_text' => '{SHOWADDMAILACCOUNT__SUBMIT}',
			'reset_text' => '{SHOWADDMAILACCOUNT__RESET}',
			'submit_href_event' => '$$$addMailaccount'
		)); ?>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('back'); ?>">
			<?php $this->set('{SHOWADDMAILACCOUNT__TOBACK}'); ?></a>
	</p>
</div>
