<!-- | TEMPLATE show help for current page -->
    <div class="$$$div__showHelp">
    <h1><?php $this->set('{SHOWHELP__H}'); ?></h1>
    <p class="ts_">
	<?php if ($this->getVar('modid')) { ?>
	<a href="<?php $this->setUrl('$$$showHelp',
	    array('$$$page' => 'mod'.$this->getVar('modid').'__index')
	); ?>">
	    <?php $this->set('{SHOWHELP__TOINDEX}'); ?></a>
	<?php } else { ?>
	<a href="<?php $this->setUrl('$$$showMain'); ?>">
	    <?php $this->set('{SHOWHELP__TOMAIN}'); ?></a>
	<?php } ?>
    </p>
    <p class="ts_infotext"><?php $this->set('{SHOWHELP__INFOTEXT}'); ?></p>

    <div>
	<?php $this->getVar('Helpfile')->includeFile(); ?>
    </div>
</div>
