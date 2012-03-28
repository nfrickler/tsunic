<!-- | -->
<div id="$$$div__showMain">
	<h1><?php $this->set('{SHOWMAIN__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWMAIN__INFO}'); ?></p>

	<?php $this->display('$$$showMailboxes', array('mailboxes' => $this->getVar('mailboxes'))); ?>
</div>
