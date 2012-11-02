<!-- | TEMPLATE show note -->
<?php
    $FsFile = $this->getVar('FsFile');
?>
<div id="$$$div__showNote">
    <h1><?php $this->set('{SHOWNOTE__H1}',
	array('name' => $FsFile->getInfo('name'))); ?></h1>
    <p class="ts_infotext"><?php $this->set('{SHOWNOTE__INFO}'); ?></p>

    <form action="<?php $this->setUrl('$$$saveNote'); ?>" method="post" name="$$$showNote__form" id="$$$showNote__form" class="ts_form">
	<input type="hidden" name="$$$showNote__id" id="$$$showNote__id" value="<?php $this->set($FsFile->getInfo('id')); ?>" />
	<fieldset>
	    <legend><?php echo $this->set('{SHOWNOTE__LEGEND}'); ?></legend>
	    <textarea style="width:99%;" name="$$$showNote__content" rows="20" id="$$$showNote__content"><?php $this->setPreset('$$$showNote__content', $FsFile->getContent()); ?></textarea>
	    <div style="clear:both;"></div>
	</fieldset>
	<fieldset>
	    <legend><?php echo $this->set('{SHOWNOTE__LEGEND_SAVE}'); ?></legend>
	    <label for="$$$showNote__filename"><?php $this->set('{SHOWNOTE__FILENAME}'); ?></label>
	    <input class="ts_required" type="text" name="$$$showNote__filename" id="$$$showNote__filename" value="<?php $this->setPreset('$$$showNote__filename', $FsFile->getAbsPath()); ?>" />
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWNOTE__SUBMIT}'); ?>" />
	<a class="ts_cancel" href=""><?php $this->set('{SHOWNOTE__CANCEL}'); ?></a>
    </form>
</div>

<script type="text/javascript">

    // all input-fields in form
    var $$$showNote__allInputs = new Array();
    $$$showNote__allInputs[0] = new Array(
	'$$$showNote__filename',
	'<?php $this->setjs('{SHOWNOTE__PRESET_FILENAME}'); ?>',
	'<?php $this->setjs('{SHOWNOTE__HELP_FILENAME}'); ?>');
    $$$showNote__allInputs[1] = new Array(
	'$$$showNote__content',
	'<?php $this->setjs('{SHOWNOTE__PRESET_CONTENT}'); ?>',
	'');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$showNote__form'), $$$showNote__allInputs);
</script>
