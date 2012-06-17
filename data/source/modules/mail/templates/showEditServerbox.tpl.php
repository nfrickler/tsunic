<!-- | show form to edit serverbox -->
<div id="$$$div__showEditMailserver">
    <h1><?php $this->set('{SHOWEDITSERVERBOX__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showDeleteServerbox', array('$$$id' => $this->getVar('Serverbox')->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITSERVERBOX__TODELETESERVERBOX}'); ?></a>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWEDITSERVERBOX__INFO}'); ?></p>
    <?php $this->display('$$$formServerbox', array(
	'Serverbox' => $this->getVar('Serverbox'),
	'mailboxes' => $this->getVar('mailboxes'),
	'submit_text' => '{SHOWEDITSERVERBOX__SUBMIT}',
	'reset_text' => '{SHOWEDITSERVERBOX__RESET}',
	'submit_href_event' => '$$$editServerbox'
    )); ?>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('back'); ?>">
	    <?php $this->set('{SHOWEDITSERVERBOX__TOOVERVIEW}'); ?></a>
    </p>
</div>
