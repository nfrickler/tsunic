<!-- | TEMPLATE show form to edit a Mail -->
<?php $Mail = $this->getVar('Mail'); ?>
<div id="$$$div__showEditMail">
    <h1><?php $this->set('{SHOWEDITMAIL__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITMAIL__INFO}'); ?></p>
    <?php $this->display('$$$formMail', array(
	'Mail' => $Mail,
	'sender' => $this->getVar('sender'),
	'submit_text' => '{SHOWEDITMAIL__SUBMIT}',
	'save_text' => '{SHOWEDITMAIL__SUBMIT_SAVE}',
	'reset_text' => '{SHOWEDITMAIL__CANCEL}',
	'submit_href_event' => '$$$updateMail',
	'cancel_href' => $this->setUrl(
	    '$$$showMail', array(
		'$$$id' => $Mail->getInfo('id')
	    ), true, false
	)
    )); ?>
</div>
