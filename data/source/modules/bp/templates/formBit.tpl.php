<!-- | TEMPLATE show form for bit -->
<?php
$Bit = $this->getVar('Bit');
$Tag = $Bit->getTag();
$num = $this->getVar('num');

?>
	<input type="hidden" name="$$$formBit__fk_tag__<?php echo $num; ?>" id="$$$formBit__fk_tag__<?php echo $num; ?>" value="<?php echo $Tag->getInfo('id'); ?>" />
	<input type="hidden" name="$$$formBit__fk_bit__<?php echo $num; ?>" id="$$$formBit__fk_bit__<?php echo $num; ?>" value="<?php echo $Bit->getInfo('id'); ?>" />
<?php

switch ($Tag->getType()->getInfo('name')) {

    case 'int':
    case 'double':
    case 'string':
	$name = $this->set($Bit->getTag()->getInfo('title'), false, false);
?>
	<label for="$$$formBit__<?php echo $num; ?>"><?php echo $name; ?></label>
	<input type="text" name="$$$formBit__value__<?php echo $num; ?>" id="$$$formBit__value__<?php echo $num; ?>" value="<?php $this->setPreset('$$$formBit__value__'.$num, $Bit->getInfo('value')); ?>" />
	<div style="clear:both;"></div>
<?php
	break;
    case 'text':
	$name = $this->set($Bit->getTag()->getInfo('title'), false, false);
?>
	<label for="$$$formBit__<?php echo $num; ?>"><?php echo $name; ?></label>
	<textarea name="$$$formBit__<?php echo $num; ?>" id="$$$formBit__<?php echo $num; ?>"><?php $this->setPreset('$$$formSelection__'.$num, $Bit->getInfo('value')); ?></textarea>
	<div style="clear:both;"></div>
<?php
	break;
    case 'selection':
	$name = $this->set($Bit->getTag()->getInfo('title'), false, false);
	$preset = $this->setPreset('$$$formBit__value__'.$num, $Bit->getInfo('value'), false);
?>
	    <label for="$$$formBit__value__<?php echo $num; ?>"><?php echo $name; ?></label>
	    <select name="$$$formBit__value__<?php echo $num; ?>" id="$$$formBit__value__<?php echo $num; ?>" multiple="multiple">
		<option value="0"><?php $this->set('{FORMBIT__PLEASECHOOSE}'); ?></option>
		<?php foreach ($Bit->getTag()->getSelections() as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('name')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
<?php
	break;

    case 'radio':
	$name = $this->set($Bit->getTag()->getInfo('title'), false, false);
	$preset = $this->setPreset('$$$formBit__value__'.$num, $Bit->getInfo('value'), false);
?>
	    <label for="$$$formBit__value__<?php echo $num; ?>"><?php echo $name; ?></label>
	    <select name="$$$formBit__value__<?php echo $num; ?>" id="$$$formBit__value__<?php echo $num; ?>">
		<option value="0"><?php $this->set('{FORMBIT__PLEASECHOOSE}'); ?></option>
		<?php foreach ($Bit->getTag()->getSelections() as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('name')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
<?php
	break;
    default:
	break;
}
?>

<script type="text/javascript">

    // all input-fields in form
    var $$$formSelection__allInputs = new Array();
    $$$formBit__<?php echo $num; ?>__allInputs[0] = new Array('$$$formBit__<?php echo $num; ?>',
	'<?php $this->setjs($Tag->getInfo('title')); ?>',
	'<?php $this->setjs($Tag->getInfo('description')); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formBit__form'), $$$formBit__<?php echo $num; ?>);
</script>
