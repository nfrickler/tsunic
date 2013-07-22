<!-- | TEMPLATE show form to link an object -->
<div id="$$$div__formLinkObject">

    <?php foreach ($this->getVar('objects') as $class => $objects) { ?>
    <h3><?php $this->set($class); ?></h3>
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formLinkObject__form" id="$$$formLinkObject__form" class="ts_form">
	<input type="hidden" name="$$$formLinkObject__backlink" id="$$$formLinkObject__backlink" value="<?php echo $this->getVar('backlink'); ?>" />
	<input type="hidden" name="$$$formLinkObject__fk_obj" id="$$$formLinkObject__fk_obj" value="<?php echo $this->getVar('fk_obj'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMLINKOBJECT__LEGEND}'); ?></legend>
	    <label for="$$$formLinkObject__obj2link"><?php $this->set('{FORMSELECTION__FK_TAG}'); ?></label>
	    <select name="$$$formLinkObject__obj2link" id="$$$formLinkObject__obj2link">
		<option value="0"><?php $this->set('{FORMLINKOBJECT__PLEASECHOOSE}'); ?></option>
		<?php foreach ($objects as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>"><?php $this->set($Value->getName()); ?></option>
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
    <?php } ?>

</div>
