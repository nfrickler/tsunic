<!-- | TEMPLATE show form for profile -->
<?php
$Profile = $this->getVar('Profile');
?>
<div id="$$$div__formProfile">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formProfile__form" id="$$$formProfile__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{FORMPROFILE__LEGEND}'); ?></legend>
	    <label for="$$$formProfile__firstname"><?php $this->set('{FORMPROFILE__FIRSTNAME}'); ?></label>
	    <input type="text" name="$$$formProfile__firstname" id="$$$formProfile__firstname" value="<?php $this->setPreset('$$$formProfile__firstname', $Profile->getInfo('firstname')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formProfile__lastname"><?php $this->set('{FORMPROFILE__LASTNAME}'); ?></label>
	    <input type="text" name="$$$formProfile__lastname" id="$$$formProfile__lastname" value="<?php $this->setPreset('$$$formProfile__lastname', $Profile->getInfo('lastname')); ?>" />
	    <div style="clear:both;"></div>
	    <label for="$$$formProfile__dateofbirth_d"><?php $this->set('{FORMPROFILE__DATEOFBIRTH}'); ?></label>
	    <?php $preset = $this->setPreset('$$$formProfile__dateOfBirth_d', $Profile->getInfo('dateOfBirth_d'), false); ?>
	    <select name="$$$formProfile__dateOfBirth" id="$$$formProfile__dateOfBirth_d" style="width:80px;">
		<?php for ($i = 1; $i <= 31; $i++) { ?>
		    <option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formProfile__dateOfBirth_m', $Profile->getInfo('dateOfBirth_m'), false); ?>
	    <select name="$$$formProfile__dateOfBirth_m" id="$$$formProfile__dateOfBirth_m" style="width:80px;">
		<?php for ($i = 1; $i <= 12; $i++) { ?>
		    <option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formProfile__dateOfBirth_y', $Profile->getInfo('dateOfBirth_y'), false); ?>
	    <select name="$$$formProfile__dateOfBirth_y" id="$$$formProfile__dateOfBirth_y" style="width:80px;">
		<?php for ($i = date("Y"); $i > date("Y")-300; $i--) { ?>
		    <option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
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
    var $$$formProfile__allInputs = new Array();
    $$$formProfile__allInputs[0] = new Array('$$$formProfile__firstname',
	'<?php $this->setjs('{FORMPROFILE__FIRSTNAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMPROFILE__FIRSTNAME_HELP}'); ?>');
    $$$formProfile__allInputs[1] = new Array('$$$formProfile__lastname',
	'<?php $this->setjs('{FORMPROFILE__LASTNAME_PRESET}'); ?>',
	'<?php $this->setjs('{FORMPROFILE__LASTNAME_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formProfile__form'), $$$formProfile__allInputs);
</script>
