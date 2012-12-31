<!-- | TEMPLATE show form for profile -->
<?php
$Profile = $this->getVar('Profile');
$num = 0;
?>
<div id="$$$div__formProfile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formProfile__form" id="$$$formProfile__form" class="ts_form">
	<input type="hidden" name="$$$formProfile__id" id="$$$formProfile__id" value="<?php echo $Profile->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND_ID}'); ?></legend>
	    <?php
	    $defaultBits = $Profile->getDefaultBits();
	    foreach ($defaultBits as $index => $Value) {
		$this->display('$bp$formBit', array(
		    'Bit' => $Value,
		    'num' => $num++,
		));
	    }
	    ?>
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
