<!-- | TEMPLATE show form for filesystem file -->
<?php
$File = $this->getVar('File');
$num = 0;
?>
<div id="$$$div__formFile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formFile__form" id="$$$formFile__form" class="ts_form" enctype="multipart/form-data">
	<fieldset>
	    <legend><?php $this->set('{FORMFILE__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formFile__id" id="$$$formFile__id" value="<?php echo $File->getInfo('id'); ?>" />
	    <input type="hidden" name="$$$formFile__parent_preset" id="$$$formFile__parent_preset" value="<?php echo $this->getVar('fk_directory'); ?>" />
	    <?php
	    $this->display('$bp$formBit', array(
		'Bit' => $File->getBit('FILE__NAME'),
		'num' => $num++,
	    ));

	    if ($this->getVar('showUpload')) {
	    ?>
	    <label for="$$$formFile__file"><?php echo $this->set('{FORMFILE__FILE}'); ?></label>
	    <input type="file" class="ts_required" name="$$$formFile__file" id="$$$formFile__file" />
	    <div style="clear:both;"></div>
	    <?php } ?>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<a class="ts_reset" href="<?php $this->setUrl('back'); ?>"><?php $this->set('#reset_text#'); ?></a>
    </form>
</div>
