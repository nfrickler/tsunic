<!-- | TEMPLATE show form for filesystem file -->
<?php
$File = $this->getVar('File');
$directory_preset = (!$File->getInfo('id')) ? $this->getVar('fk_directory') : $File->getInfo('fk_directory');
$directory_preset = $this->setPreset('$$$formFsFile__directory', $directory_preset, false);
?>
<div id="$$$div__formFsFile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formFsFile__form" id="$$$formFsFile__form" class="ts_form" enctype="multipart/form-data">
	<fieldset>
	    <legend><?php echo $this->set('{FORMFSFILE__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formFsFile__id" id="$$$formFsFile__id" value="<?php echo $File->getInfo('id'); ?>" />
	    <?php if ($File->getInfo('id')) { ?>
	    <label for="$$$formFsFile__name"><?php echo $this->set('{FORMFSFILE__NAME}'); ?></label>
	    <input type="text" class="ts_required" name="$$$formFsFile__name" id="$$$formFsFile__name" value="<?php $this->setPreset('$$$formFsFile__name', $File->getInfo('name')); ?>" />
	    <div style="clear:both;"></div>
	    <?php } else { ?>
	    <label for="$$$formFsFile__file"><?php echo $this->set('{FORMFSFILE__FILE}'); ?></label>
	    <input type="file" class="ts_required" name="$$$formFsFile__file" id="$$$formFsFile__file" />
	    <div style="clear:both;"></div>
	    <?php } ?>
	    <label for="$$$formFsFile__directory"><?php echo $this->set('{FORMFSFILE__DIRECTORY}'); ?></label>
	    <select class="ts_required" name="$$$formFsFile__directory" id="$$$formFsFile__directory">
		<option value="0"><?php $this->set('{FORMFSFILE__OPTION_ROOTDIR}'); ?></option>
		<?php foreach ($this->getVar('directories') as $id => $name) { ?>
		<option value="<?php echo $id; ?>" <?php if ($directory_preset == $id) echo 'selected="selected"'; ?>>
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
    var $$$formFsFile__allInputs = new Array();
    <?php if ($File->getInfo('id')) { ?>
    $$$formFsFile__allInputs[0] = new Array('$$$formFsFile__name',
	'<?php $this->setjs('{FORMFSFILE__NAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMFSFILE__NAME_HELP}'); ?>');
    <?php } else { ?>
    $$$formFsFile__allInputs[0] = new Array('$$$formFsFile__file',
	'',
	'<?php $this->setjs('{FORMFSFILE__FILE_HELP}'); ?>');
    <?php } ?>
    $$$formFsFile__allInputs[1] = new Array('$$$formFsFile__directory',
	'',
	'<?php $this->setjs('{FORMFSFILE__DIRECTORY_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formFsFile__form'), $$$formFsFile__allInputs);
</script>
