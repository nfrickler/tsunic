<!-- | TEMPLATE show form for Mail -->
<?php
$Mail = $this->getVar('Mail');
$num = 0;
?>
<div id="$$$div__formMail">
    <form action="<?php $this->setUrl($this->getVar('submit_href_event')); ?>" method="post" name="$$$formMail__form" id="$$$formMail__form" class="ts_form">
	<input type="hidden" name="$$$formMail__id" id="$$$formMail__id" value="<?php $this->set($Mail->getInfo('id')); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMMAIL__LEGEND_HEADER}'); ?></legend>
	    <label for="$$$formMail__sender"><?php $this->set('{TAG__MAIL__SENDER}'); ?></label>
	    <select name="$$$formMail__sender" id="$$$formMail__sender">
		<?php $selected = $this->setPreset('$$$formMail__sender', $Mail->getInfo('sender'), false); ?>
		<?php foreach ($this->getVar('sender') as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($selected == $Value->getInfo('id')) echo "selected='selected'"; ?>>
		    <?php $this->set($Value->getName()); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Mail->getBit('MAIL__ADDRESSEE'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Mail->getBit('MAIL__SUBJECT'),
		'num' => $num++,
	    ));
	    ?>
	</fieldset>
	<fieldset>
	    <legend><?php $this->set('{FORMMAIL__LEGEND_CONTENT}'); ?></legend>
	    <textarea style="width:99%" name="$$$formMail__content" rows="20" id="$$$formMail__content"><?php $this->setPreset('$$$formMail__content', $Mail->getPlainContent()); ?></textarea>
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" name="$$$formMail__send" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<input type="submit" name="$$$formMail__save" class="ts_submit" value="<?php $this->set('#save_text#'); ?>" />
	<?php if ($this->getVar('cancel_href')) { ?>
	<a class="ts_cancel" href="<?php echo $this->getVar('cancel_href'); ?>">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
