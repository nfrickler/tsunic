<!-- | -->
<div id="$$$div__showEditSmtp">
	<h1><?php $this->set('{SHOWEDITSMTP__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITSMTP__INFO}'); ?></p>
	<?php $this->display('$$$formSmtp', array('Smtp' => $this->getVar('Smtp'),
		'mailaccounts' => $this->getVar('mailaccounts'),
		'submit_text' => '{SHOWEDITSMTP__SUBMIT}',
		'reset_text' => '{SHOWEDITSMTP__RESET}',
		'submit_href_event' => '$$$editSmtp')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('back'); ?>">
			<?php $this->set('{SHOWEDITSMTP__TOOVERVIEW}'); ?></a>
	</p>
</div>
