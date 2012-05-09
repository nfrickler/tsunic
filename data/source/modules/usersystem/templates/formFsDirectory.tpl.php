<!-- | TEMPLATE show form for filesystem directory -->
<?php
$Dir = $this->getVar('Directory');
$name_preset = (!$Dir->getInfo('id')) ? '' : $Dir->getInfo('name');
$name_preset = $this->setPreset('$$$formFsDirectory__name', $name_preset, false);
$parent_preset = (!$Dir->getInfo('id')) ? $this->getVar('fk_parent') : $Dir->getInfo('fk_parent');
$parent_preset = $this->setPreset('$$$formFsDirectory__parent', $parent_preset, false);
?>
<div id="$$$div__formFsDirectory">
	<form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formFsDirectory__form" id="$$$formFsDirectory__form" class="ts_form">
		<fieldset>
			<legend><?php echo $this->set('{FORMFSDIRECTORY__LEGEND}'); ?></legend>
			<input type="hidden" name="$$$formFsDirectory__id" id="$$$formFsDirectory__id" value="<?php echo $Dir->getInfo('id'); ?>" />
			<label for="$$$formFsDirectory__name"><?php echo $this->set('{FORMFSDIRECTORY__NAME}'); ?></label>
			<input type="text" class="ts_required" name="$$$formFsDirectory__name" id="$$$formFsDirectory__name" value="<?php echo $name_preset; ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formFsDirectory__parent"><?php echo $this->set('{FORMFSDIRECTORY__PARENT}'); ?></label>
			<select class="ts_required" name="$$$formFsDirectory__parent" id="$$$formFsDirectory__parent">
				<option value="0"><?php $this->set('{FORMFSDIRECTORY__OPTION_ROOTDIR}'); ?></option>
				<?php foreach ($this->getVar('directories') as $id => $name) { ?>
				<option value="<?php echo $id; ?>" <?php if ($parent_preset == $id) echo 'selected="selected"'; ?>>
					<?php $this->set($name); ?>
				</option>
				<?php } ?>
			</select>
			<div style="clear:both;"></div>
		</fieldset>
		<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
		<a class="ts_reset" href="<?php $this->setUrl('back'); ?>"><?php $this->set('#reset_text#'); ?></a>
	</form>
</div>
<script type="text/javascript">

	// all input-fields in form
	var $$$formFsDirectory__allInputs = new Array();
	$$$formFsDirectory__allInputs[0] = new Array('$$$formFsDirectory__name',
		'<?php $this->setjs('{FORMFSDIRECTORY__NAME_PRESET}'); ?>',
		'<?php $this->setjs('{FORMFSDIRECTORY__NAME_HELP}'); ?>');
	$$$formFsDirectory__allInputs[1] = new Array('$$$formFsDirectory__parent',
		'',
		'<?php $this->setjs('{FORMFSDIRECTORY__PARENT_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formFsDirectory__form'), $$$formFsDirectory__allInputs);
</script>
