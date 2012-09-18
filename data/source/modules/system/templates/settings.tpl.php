<!-- | TEMPLATE show setting bar -->
<div id="$$$div__settings">
    <?php if ($TSunic->isJavascript() == true) { ?>
    <a href="<?php $this->setUrl('$$$disableJavascript'); ?>">
	<img src="<?php $this->setImg('project', '$$$javascript_enabled.gif'); ?>" alt="<?php $this->set('{SETTINGS__ENABLEJAVASCRIPT}'); ?>" style="height:20px; width:20px;" />
    </a>
    <?php } else { ?>
    <a href="<?php $this->setUrl('$$$enableJavascript'); ?>">
	<img src="<?php $this->setImg('project', '$$$javascript_disabled.gif'); ?>" alt="<?php $this->set('{SETTINGS__DISABLEJAVASCRIPT}'); ?>" style="height:20px; width:20px;" />
    </a>
    <?php } ?>
    <ul>
	<li>
	    <a href="<?php $this->setUrl('$$$setLanguage', array('lang' => 'en')); ?>">
		en
	    </a>
	</li>
	<li>
	    <a href="<?php $this->setUrl('$$$setLanguage', array('lang' => 'de')); ?>">
		de
	    </a>
	</li>
    </ul>
    <?php $this->displaySub('$$$settings'); ?>
</div>
