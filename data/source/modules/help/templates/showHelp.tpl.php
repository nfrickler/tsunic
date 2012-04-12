<!-- | TEMPLATE show help for current page -->
<div class="$$$div__showHelp">
	<h1><?php $this->set('{SHOWHELP__H}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWHELP__INTRO}'); ?></ü>

	<div>
		<?php $this->getVar('Helpfile')->includeFile(); ?>
	</div>
</div>
