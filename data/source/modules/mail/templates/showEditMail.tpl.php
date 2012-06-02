<!-- | Template: show form to edit a mail -->
<div id="$$$div__showEditMail">
	<h1><?php $this->set('{SHOWEDITMAIL__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITMAIL__INFO}'); ?></p>
	<?php $this->display('$$$formMail', array(
		'Mail' => $this->getVar('Mail'),
		'smtps' => $this->getVar('smtps'),
		'submit_text' => '{SHOWEDITMAIL__SUBMIT}',
		'save_text' => '{SHOWEDITMAIL__SUBMIT_SAVE}',
		'reset_text' => '{SHOWEDITMAIL__CANCEL}',
		'submit_href_event' => '$$$saveMail',
		'cancel_href' => $this->setUrl(
		    '$$$showMailbox', array(
			'$$$id' => $this->getVar('Mail')->getMailbox()->getInfo('id')
		    ), true, false
		)
	)); ?>
</div>
