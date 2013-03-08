<!-- | TEMPLATE show form for date -->
<?php
$Date = $this->getVar('Date');
$num = 0;
?>
<div id="$$$div__formDate">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formDate__form" id="$$$formDate__form" class="ts_form">
	<input type="hidden" name="$$$formDate__id" id="$$$formDate__id" value="<?php echo $Date->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMDATE__LEGEND_ID}'); ?></legend>
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Date->getBit('DATE__TITLE'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Date->getBit('DATE__START'),
		'num' => $num++,
		'required' => true,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Date->getBit('DATE__STOP'),
		'num' => $num++,
		'required' => true,
	    ));
	    ?>

	    <label for="$$$formDate__repeat"><?php $this->set('{FORMDATE__REPEAT}'); ?></label>

	    <input type="text" name="$$$formDate__repeat" id="$$$formDate__repeat" value="<?php $this->setPreset('$$$formDate__repeat', $Date->getInfo('repeat')); ?>" style="width:100px;" />
	    <?php
	    $preset = $this->setPreset('$$$formDate__repeattype', $Date->getInfo('repeattype'), false);
	    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__REPEATTYPE'));
	    ?>
	    <select name="$$$formDate__repeattype" id="$$$formDate__repeattype" style="width:300px;">
		<?php foreach ($Tag->getSelections() as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('name')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>

	    <label for="$$$formDate__repeat"><?php $this->set('{FORMDATE__REPEAT__COUNT}'); ?></label>
	    <input class="ts_radio" <?php if ($this->getVar('preset_radio')) echo 'checked="checked"'; ?> style="width:40px; padding:10px;" type="radio" id="$$$formDate__repeat_radio" name="$$$formDate__repeat_radio" value="1" />
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Date->getBit('DATE__REPEATCOUNT'),
		'num' => $num++,
		'show_label' => false,
	    ));
	    ?>
	    <div style="clear:both;"></div>

	    <label for="$$$formDate__repeat"><?php $this->set('{FORMDATE__REPEAT__UNTIL}'); ?></label>
	    <input class="ts_radio" <?php if (!$this->getVar('preset_radio')) echo 'checked="checked"'; ?> style="width:40px; padding:10px;" type="radio" id="$$$formDate__repeat_radio" name="$$$formDate__repeat_radio" value="0" />
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Date->getBit('DATE__REPEATSTOP'),
		'num' => $num++,
		'show_label' => false,
	    ));
	    ?>
	    <div style="clear:both;"></div>
	</fieldset>
	<?php if ($Date->getBits(false)) { ?>
	<fieldset>
	    <legend><?php $this->set('{FORMDATE__LEGEND}'); ?></legend>
	    <?php
	    foreach ($Date->getBits(false) as $index => $Value) {
		$this->display('$bp$formBit', array(
		    'Bit' => $Value,
		    'num' => $num++,
		));
	    }
	    ?>
	</fieldset>
	<?php } ?>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<?php if ($this->getVar('reset_text')) { ?>
	<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
