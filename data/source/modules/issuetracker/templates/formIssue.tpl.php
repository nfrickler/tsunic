<!-- | TEMPLATE show form for issue -->
<?php
$Issue = $this->getVar('Issue');
$num = 0;
?>
<div id="$$$div__formIssue">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formIssue__form" id="$$$formIssue__form" class="ts_form">
	<input type="hidden" name="$$$formIssue__id" id="$$$formIssue__id" value="<?php echo $Issue->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMISSUE__LEGEND_ID}'); ?></legend>
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Issue->getBit('ISSUE__NAME'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Issue->getBit('ISSUE__DESCRIPTION'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Issue->getBit('ISSUE__MAINTAINER'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Issue->getBit('ISSUE__QUEUE'),
		'num' => $num++,
	    ));
	    $this->display('$bp$formBit', array(
		'Bit' => $Issue->getBit('ISSUE__STATUS'),
		'num' => $num++,
	    ));
	    ?>
	</fieldset>
	<?php
	$bits = $Issue->getBits(false);
	if ($bits) {
	?>
	<fieldset>
	    <legend><?php $this->set('{FORMISSUE__LEGEND}'); ?></legend>
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
