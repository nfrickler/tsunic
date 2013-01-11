<!-- | TEMPLATE show form to add tag to object-->
<div id="$$$div__formAddTag">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formAddTag__form" id="$$$formAddTag__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMADDTAG__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formAddTag__fk_obj" id="$$$formAddTag__fk_obj" value="<?php echo $this->getVar('fk_obj'); ?>">
	    <label for="$$$formAddTag__fk_tag"><?php $this->set('{FORMADDTAG__FK_TAG}'); ?></label>
	    <?php
	    $preset = $this->setPreset('$$$formAddTag__fk_tag', '', false);
	    ?>
	    <select name="$$$formAddTag__fk_tag" id="$$$formAddTag__fk_tag">
		<option value="0"><?php $this->set('{FORMADDTAG__FK_TAG_PLEASECHOOSE}'); ?></option>
		<?php foreach ($this->getVar('tags') as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('title')); ?>
		</option>
		<?php } ?>
	    </select>
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
    var $$$formAddTag__allInputs = new Array();
    $$$formAddTag__allInputs[0] = new Array('$$$formAddTag__fk_tag',
	'',
	'<?php $this->setjs('{FORMADDTAG__FK_TAG_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formAddTag__form'), $$$formAddTag__allInputs);
</script>
