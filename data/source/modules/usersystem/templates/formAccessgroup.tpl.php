<!-- | TEMPLATE show form for accessgroup -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__formAccessgroup">
	<form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formAccessgroup__form" id="$$$formAccessgroup__form" class="ts_form">
		<fieldset>
			<legend><?php echo $this->set('{FORMACCESSGROUP__LEGEND}'); ?></legend>
			<label for="$$$formAccessgroup__name"><?php echo $this->set('{FORMACCESSGROUP__NAME}'); ?></label>
			<input type="text" class="ts_required" name="$$$formAccessgroup__name" id="$$$formAccessgroup__name" value="<?php $this->setPreset('$$$formAccessgroup__name', $Accessgroup->getInfo('name')); ?>" />
			<div style="clear:both;"></div>
			<label for="$$$formAccessgroup__parent"><?php echo $this->set('{FORMACCESSGROUP__PARENT}'); ?></label>
			<select class="ts_required" name="$$$formAccessgroup__parent" id="$$$formAccessgroup__parent">
				<?php foreach ($this->getVar('accessgroups') as $id => $name) { ?>
				<option value="<?php echo $id; ?>" <?php if ($this->setPreset('$$$formAccessgroup__parent', $Accessgroup->getInfo('id')) == $id) echo 'selected="selected"'; ?>>
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
	var $$$formAccessgroup__allInputs = new Array();
	$$$formAccessgroup__allInputs[0] = new Array('$$$formAccessgroup__name',
		'<?php $this->setjs('{FORMACCESSGROUP__NAME_PRESET}'); ?>',
		'<?php $this->setjs('{FORMACCESSGROUP__NAME_HELP}'); ?>');
	$$$formAccessgroup__allInputs[1] = new Array('$$$formAccessgroup__parent',
		'',
		'<?php $this->setjs('{FORMACCESSGROUP__PARENT_HELP}'); ?>');

	// add help to form
	$system$showFormHelp(document.getElementById('$$$formAccessgroup__form'), $$$formAccessgroup__allInputs);
</script>
