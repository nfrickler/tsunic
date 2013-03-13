<!-- | TEMPLATE show form for queue -->
<?php
$Queue = $this->getVar('Queue');
$num = 0;
?>
<div id="$$$div__formQueue">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formQueue__form" id="$$$formQueue__form" class="ts_form">
	<input type="hidden" name="$$$formQueue__id" id="$$$formQueue__id" value="<?php echo $Queue->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMQUEUE__LEGEND_ID}'); ?></legend>
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Queue->getBit('QUEUE__NAME'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Queue->getBit('QUEUE__DESCRIPTION'),
		'num' => $num++,
	    ));
	    ?>
	</fieldset>
	<?php
	$bits = $Queue->getBits(false);
	if ($bits) {
	?>
	<fieldset>
	    <legend><?php $this->set('{FORMQUEUE__LEGEND}'); ?></legend>
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
