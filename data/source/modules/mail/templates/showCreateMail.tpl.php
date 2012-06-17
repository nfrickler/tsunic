<!-- | Template: show form to create new mail -->
<div id="$$$div__showCreateMail">
    <h1><?php $this->set('{SHOWCREATEMAIL__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWCREATEMAIL__INFO}'); ?></p>
    <?php $this->display('$$$formMail', array(
	'Mail' => $this->getVar('Mail'),
	'smtps' => $this->getVar('smtps'),
	'submit_text' => '{SHOWCREATEMAIL__SUBMIT}',
	'save_text' => '{SHOWCREATEMAIL__SUBMIT_SAVE}',
	'reset_text' => '{SHOWCREATEMAIL__CANCEL}',
	'submit_href_event' => '$$$saveMail')
    ); ?>
</div>
