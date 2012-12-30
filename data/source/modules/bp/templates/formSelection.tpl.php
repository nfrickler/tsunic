<!-- | TEMPLATE show form for selection -->
<?php
$Selection = $this->getVar('Selection');
?>
<div id="$$$div__formSelection">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formSelection__form" id="$$$formSelection__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMSELECTION__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formSelection__id" id="$$$formSelection__id" value="<?php echo $Selection->getInfo('id'); ?>">
	    <label for="$$$formSelection__fk_tag"><?php $this->set('{FORMSELECTION__FK_TAG}'); ?></label>
	    <?php
	    $preset = ($Selection->getInfo('fk_tag')) ? $Selection->getInfo('fk_tag') : $this->getVar('fk_tag');
	    $preset = $this->setPreset('$$$formSelection__fk_tag', $preset, false);
	    ?>
	    <select name="$$$formSelection__fk_tag" id="$$$formSelection__fk_tag">
		<option value="0"><?php $this->set('{FORMSELECTION__FK_TAG_PLEASECHOOSE}'); ?></option>
		<?php foreach ($Selection->getAllTags(true) as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('title')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
	    <label for="$$$formSelection__name"><?php $this->set('{FORMSELECTION__NAME}'); ?></label>
	    <input type="text" name="$$$formSelection__name" id="$$$formSelection__name" value="<?php $this->setPreset('$$$formSelection__name', $Selection->getInfo('name')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formSelection__description"><?php $this->set('{FORMSELECTION__DESCRIPTION}'); ?></label>
	    <textarea name="$$$formSelection__description" id="$$$formSelection__description"><?php $this->setPreset('$$$formSelection__description', $Selection->getInfo('description')); ?></textarea>
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<?php if ($this->getVar('reset_text')) { ?>
	<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
<script type="text/javascript">

    // all input-fields in form
    var $$$formSelection__allInputs = new Array();
    $$$formSelection__allInputs[0] = new Array('$$$formSelection__name',
	'<?php $this->setjs('{FORMSELECTION__NAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMSELECTION__NAME_HELP}'); ?>');
    $$$formSelection__allInputs[1] = new Array('$$$formSelection__fk_tag',
	'',
	'<?php $this->setjs('{FORMSELECTION__FK_TAG_HELP}'); ?>');
    $$$formSelection__allInputs[2] = new Array('$$$formSelection__description',
	'<?php $this->setjs('{FORMSELECTION__DESCRIPTION_PRESET}'); ?>',
	'<?php $this->setjs('{FORMSELECTION__DESCRIPTION_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formSelection__form'), $$$formSelection__allInputs);
</script>
