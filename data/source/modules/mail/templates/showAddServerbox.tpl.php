<!-- | Template: show form to add new server -->
<div id="$$$div__showAddMailserver">
    <h1><?php $this->set('{SHOWADDSERVERBOX__H1}'); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWADDSERVERBOX__INFO}'); ?></p>
    <?php $this->display('$$$formServerbox', array(
	'Serverbox' => $this->getVar('Serverbox'),
	'Mailaccount' => $this->getVar('Mailaccount'),
	'mailboxes' => $this->getVar('mailboxes'),
	'submit_text' => '{SHOWADDSERVERBOX__SUBMIT}',
	'reset_text' => '{SHOWADDSERVERBOX__RESET}',
	'submit_href_event' => '$$$addServerbox')
    ); ?>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('back'); ?>">
	    <?php $this->set('{SHOWADDSERVERBOX__TOOVERVIEW}'); ?></a>
    </p>
</div>
