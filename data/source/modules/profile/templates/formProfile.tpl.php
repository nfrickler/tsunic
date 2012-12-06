<!-- | TEMPLATE show form for profile -->
<?php
$Profile = $this->getVar('Profile');
?>
<div id="$$$div__formProfile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formProfile__form" id="$$$formProfile__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND}'); ?></legend>
	    <label for="$$$formProfile__firstname"><?php $this->set('{FORMPROFILE__FIRSTNAME}'); ?></label>
	    <input type="text" class="ts_required" name="$$$formProfile__firstname" id="$$$formProfile__firstname" value="<?php $this->setPreset('$$$formProfile__firstname', $Profile->getInfo('firstname')); ?>" />
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
    var $$$formProfile__allInputs = new Array();
    $$$formProfile__allInputs[0] = new Array('$$$formProfile__firstname',
	'<?php $this->setjs('{FORMPROFILE__FIRSTNAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMPROFILE__FIRSTNAME_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formProfile__form'), $$$formProfile__allInputs);
</script>
