<!-- | Template: show form to add account -->
<div id="$$$div__showAddAccount">
	<h1><?php $this->set('{SHOWADDACCOUNT__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWADDACCOUNT__INFO}'); ?></p>

	<?php $this->display(
		'$$$formAccount',
		array('Mailaccount' => $this->getVar('Mailaccount'),
			'submit_text' => '{SHOWADDACCOUNT__SUBMIT}',
			'reset_text' => '{SHOWADDACCOUNT__RESET}',
			'submit_href_event' => '$$$addAccount'
		)); ?>

	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('back'); ?>">
			<?php $this->set('{SHOWADDACCOUNT__TOBACK}'); ?></a>
	</p>
</div>
