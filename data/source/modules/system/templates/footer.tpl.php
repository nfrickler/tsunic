<!-- | TEMPLATE show content of TSunic -->
<?php
// stop system-timer
$TSunic->Stats->stopTimer('system');
?>
<div id="$$$div__footer">
    <div id="$$$div__footer_left">
	&nbsp;
    </div>
    <div id="$$$div__footer_middle">
	<span class="ts_required">&nbsp;<?php $this->set('{FOOTER__REQUIRED_INFO}'); ?>&nbsp;</span>
	<br /><br />Performance:<br />
	PHP: <?php echo round((($TSunic->Stats->getTimer('system') - $TSunic->Stats->getTimer('mysql')) * 1000), 1); ?>ms
	| MySQL: <?php echo round(($TSunic->Stats->getTimer('mysql')*1000),1); ?>ms
	| Encryption: <?php echo round(($TSunic->Stats->getTimer('encryption')*1000),1); ?>ms
	<br /><br />Powered by <a href="http://tsunic.de" target="_blank">TSunic <?php echo $TSunic->Config->get('version'); ?></a> 
	<br />Copyright &copy;2011-2013 Nicolas Frinker
	<?php $this->displaySub('system__footer'); ?>
    </div>
    <div id="$$$div__footer_right">
	<a href="<?php $this->setUrl('$$$showSysteminfo'); ?>">
	    <?php $this->set('{FOOTER__TOSYSTEMINFO}'); ?></a>
    </div>
    <div style="clear:both;"></div>
</div>
