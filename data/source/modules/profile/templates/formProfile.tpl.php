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
		'Bit' => $Profile->getBit('PROFILE__FIRSTNAME', true),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__LASTNAME', true),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__GENDER', true),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Profile->getBit('PROFILE__DATEOFBIRTH', true),
		'num' => $num++,
	    ));
	    ?>
	</fieldset>
	<?php
	$bits = $Profile->getBits(false);
	if ($bits) {
	?>
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND}'); ?></legend>
	    <?php
	    foreach ($bits as $index => $Value) {
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
