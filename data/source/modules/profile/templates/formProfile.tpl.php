<!-- | TEMPLATE show form for profile -->
<?php
$Profile = $this->getVar('Profile');
$preset_dateofbirth = $this->getVar('preset_dateofbirth');
$num = 0;
?>
<div id="$$$div__formProfile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formProfile__form" id="$$$formProfile__form" class="ts_form">
	<input type="hidden" name="$$$formProfile__id" id="$$$formProfile__id" value="<?php echo $Profile->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND_ID}'); ?></legend>
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__FIRSTNAME'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__LASTNAME'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__GENDER'),
		'num' => $num++,
	    ));
	    ?>

	    <label for="$$$formProfile__dateofbirth_d"><?php $this->set('{TAG__PROFILE__DATEOFBIRTH}'); ?></label>
	    <?php $preset = $this->setPreset('$$$formProfile__dateofbirth_d', date('d', $preset_dateofbirth), false); ?>
	    <select name="$$$formProfile__dateofbirth_d" id="$$$formProfile__dateofbirth_d" style="width:50px;" />
		<?php for ($i = 1; $i <= 31; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formProfile__dateofbirth_m', date('m', $preset_dateofbirth), false); ?>
	    <select name="$$$formProfile__dateofbirth_m" id="$$$formProfile__dateofbirth_m" style="width:50px;"/>
		<?php for ($i = 1; $i <= 12; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formProfile__dateofbirth_y', date('Y', $preset_dateofbirth), false); ?>
	    <select name="$$$formProfile__dateofbirth_y" id="$$$formProfile__dateofbirth_y" style="width:100px;"/>
		<?php for ($i = 1900; $i <= date('Y') + 100; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>

	</fieldset>
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND}'); ?></legend>
	    <?php
	    foreach ($Profile->getBits(false) as $index => $Value) {
		$this->display('$bp$formBit', array(
		    'Bit' => $Value,
		    'num' => $num++,
		));
	    }
	    ?>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<?php if ($this->getVar('reset_text')) { ?>
	<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
