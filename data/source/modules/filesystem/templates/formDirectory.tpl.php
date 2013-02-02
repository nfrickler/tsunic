<!-- | TEMPLATE show form for filesystem directory -->
<?php
$Dir = $this->getVar('Directory');
$num = 0;
?>
<div id="$$$div__formDirectory">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formDirectory__form" id="$$$formDirectory__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMDIRECTORY__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formDirectory__id" id="$$$formDirectory__id" value="<?php echo $Dir->getInfo('id'); ?>" />
	    <input type="hidden" name="$$$formDirectory__parent_preset" id="$$$formDirectory__parent_preset" value="<?php echo $this->getVar('parent_preset'); ?>" />
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $Dir->getBit('DIRECTORY__NAME'),
		'num' => $num++,
	    ));
	    if ($this->getVar('showParent')) {
		$this->display('$bp$formBit', array(
		    'Bit' => $Dir->getBit('DIRECTORY__PARENT'),
		    'num' => $num++,
		));
	    }
	    ?>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<a class="ts_reset" href="<?php $this->setUrl('back'); ?>"><?php $this->set('#reset_text#'); ?></a>
    </form>
</div>
