<!-- | TEMPLATE show form for tag -->
<?php
$Tag = $this->getVar('Tag');
?>
<div id="$$$div__formTag">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formTag__form" id="$$$formTag__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMTAG__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formTag__id" id="$$$formTag__id" value="<?php echo $Tag->getInfo('id'); ?>">
	    <label for="$$$formTag__fk_type"><?php $this->set('{FORMTAG__FK_TYPE}'); ?></label>
	    <?php
	    $preset = $this->setPreset('$$$formTag__fk_type', $Tag->getInfo('fk_type'), false);
	    ?>
	    <select name="$$$formTag__fk_type" id="$$$formTag__fk_type">
		<option value="0"><?php $this->set('{FORMTAG__FK_TYPE_PLEASECHOOSE}'); ?></option>
		<?php foreach ($Tag->getAllTypes() as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('title')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
	    <label for="$$$formTag__name"><?php $this->set('{FORMTAG__NAME}'); ?></label>
	    <input type="text" name="$$$formTag__name" id="$$$formTag__name" value="<?php $this->setPreset('$$$formTag__name', $Tag->getInfo('name')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formTag__title"><?php $this->set('{FORMTAG__TITLE}'); ?></label>
	    <input type="text" name="$$$formTag__title" id="$$$formTag__title" value="<?php $this->setPreset('$$$formTag__title', $Tag->getInfo('title')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formTag__description"><?php $this->set('{FORMTAG__DESCRIPTION}'); ?></label>
	    <textarea name="$$$formTag__description" id="$$$formTag__description"><?php $this->setPreset('$$$formTag__description', $Tag->getInfo('description')); ?></textarea>
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
    var $$$formTag__allInputs = new Array();
    $$$formTag__allInputs[0] = new Array('$$$formTag__name',
	'<?php $this->setjs('{FORMTAG__NAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMTAG__NAME_HELP}'); ?>');
    $$$formTag__allInputs[1] = new Array('$$$formTag__title',
	'<?php $this->setjs('{FORMTAG__TITLE_PRESET}'); ?>',
	'<?php $this->setjs('{FORMTAG__TITLE_HELP}'); ?>');
    $$$formTag__allInputs[2] = new Array('$$$formTag__description',
	'<?php $this->setjs('{FORMTAG__DESCRIPTION_PRESET}'); ?>',
	'<?php $this->setjs('{FORMTAG__DESCRIPTION_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formTag__form'), $$$formTag__allInputs);
</script>
