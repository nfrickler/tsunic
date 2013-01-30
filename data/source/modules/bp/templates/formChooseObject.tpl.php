<!-- | TEMPLATE show form to choose object -->
<div id="$$$div__formChooseObject">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formChooseObject__form" id="$$$formChooseObject__form" class="ts_form">
	<input type="hidden" name="$$$formChooseObject__backlink" id="$$$formChooseObject__backlink" value="<?php echo $this->getVar('backlink'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMCHOOSEOBJECT__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$formChooseObject__fk_bit" id="$$$formChooseObject__fk_bit" value="<?php echo $this->getVar('fk_bit'); ?>">
	    <div style="clear:both;"></div>
	    <?php foreach ($this->getVar('objects') as $index => $Value) { ?>
	    <input type="radio" style="width:40px; padding:10px;" name="$$$formChooseObject__fk" id="$$$formChooseObject__fk_<?php echo $Value->getInfo('id'); ?>" value="<?php echo $Value->getInfo('id'); ?>" />
	    <label style="text-align:left; width:auto;" for="$$$formChooseObject__fk_<?php echo $Value->getInfo('id'); ?>"><?php $this->set($Value->getName()); ?></label>
	    <div style="clear:both;"></div>
	    <?php } ?>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<?php if ($this->getVar('reset_text')) { ?>
	<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
