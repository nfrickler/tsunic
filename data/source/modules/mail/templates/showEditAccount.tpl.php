<!-- | -->
<div id="$$$div__showEditAccount">
	<h1><?php $this->set('{SHOWEDITACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWEDITACCOUNT__INFO}'); ?></p>
	<?php $this->display('$$$formAccount', array('Mailaccount' => $this->getVar('Mailaccount'),
		'submit_text' => '{SHOWEDITACCOUNT__SUBMIT}',
		'reset_text' => '{SHOWEDITACCOUNT__RESET}',
		'submit_href_event' => '$$$editAccount')); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
			<?php $this->set('{SHOWEDITACCOUNT__TOBACK}'); ?></a>
	</p>
</div>
