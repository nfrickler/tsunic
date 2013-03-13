<!-- | TEMPLATE show form for bit -->
<?php
$Bit = $this->getVar('Bit');
$Tag = (isset($Bit)) ? $Bit->getTag() : $this->getVar('Tag');
$value = (isset($Bit)) ? $Bit->getInfo('value') : $this->getVar('value');
$id = (isset($Bit)) ? $Bit->getInfo('id') : $this->getVar('id');
$required = ($this->getVar('required')) ? ' class="ts_required" ' : '';
$show_label = $this->getVar('show_label');
$typename = $Tag->getType()->getInfo('name');
if ($show_label === NULL) $show_label = true;

$num = $this->getVar('num');
?>
<input type="hidden" name="$$$formBit__fk_tag__<?php echo $num; ?>"
    id="$$$formBit__fk_tag__<?php echo $num; ?>"
    value="<?php echo $Tag->getInfo('id'); ?>" />
<input type="hidden" name="$$$formBit__fk_bit__<?php echo $num; ?>"
    id="$$$formBit__fk_bit__<?php echo $num; ?>"
    value="<?php echo $id; ?>" />

<?php if ($show_label) { ?>
<label for="$$$formBit__value__<?php echo $num; ?>">
    <?php $this->set($Tag->getInfo('title')); ?></label>
<?php } ?>

<?php
switch ($Tag->getType()->getInfo('name')) {

    case 'int':
    case 'double':
    case 'string':
?>
<input type="text" name="$$$formBit__value__<?php echo $num; ?>"
    <?php echo $required; ?>
    id="$$$formBit__value__<?php echo $num; ?>"
    value="<?php $this->setPreset('$$$formBit__value__'.$num, $value); ?>" />
<?php
	break;
    case 'text':
?>
<textarea name="$$$formBit__value__<?php echo $num; ?>"
    <?php echo $required; ?>
    id="$$$formBit__value__<?php echo $num; ?>"
    ><?php $this->setPreset('$$$formSelection__'.$num, $value); ?></textarea>
<?php
	break;
    case 'selection':
	$preset = $this->setPreset('$$$formBit__value__'.$num, $value, false);
?>
<select name="$$$formBit__value__<?php echo $num; ?>"
    <?php echo $required; ?>
    id="$$$formBit__value__<?php echo $num; ?>" multiple="multiple">
    <option value="0"><?php $this->set('{FORMBIT__PLEASECHOOSE}'); ?></option>
    <?php foreach ($Tag->getSelections() as $index => $Value) { ?>
    <option value="<?php echo $Value->getInfo('id'); ?>"
	<?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
	<?php $this->set($Value->getInfo('name')); ?>
    </option>
    <?php } ?>
</select>
<?php
	break;

    case 'radio':
	$preset = $this->setPreset('$$$formBit__value__'.$num, $value, false);
?>
<select name="$$$formBit__value__<?php echo $num; ?>"
    <?php echo $required; ?>
    id="$$$formBit__value__<?php echo $num; ?>">
    <option value="0"><?php $this->set('{FORMBIT__PLEASECHOOSE}'); ?></option>
    <?php foreach ($Tag->getSelections() as $index => $Value) { ?>
    <option value="<?php echo $Value->getInfo('id'); ?>"
	<?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
	<?php $this->set($Value->getInfo('name')); ?>
    </option>
    <?php } ?>
</select>
<?php
	break;

    case 'date':
	// set default to current
	if (!$value) $value = floor(time() / 3600) * 3600;
	?>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__d', date('d', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__d"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__d" style="width:50px;" />
    <?php for ($i = 1; $i <= 31; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"' ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__m', date('m', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__m"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__m" style="width:50px;"/>
    <?php for ($i = 1; $i <= 12; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"'; ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__y', date('Y', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__y"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__y" style="width:100px;"/>
    <?php for ($i = 1900; $i <= date('Y') + 100; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"'; ?>>
	<?php echo $i; ?>
    </option>
    <?php } ?>
</select>
<?php
	break;

    case 'timestamp':
	// set default to current
	if (!$value) $value = floor(time() / 3600) * 3600;
	?>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__d', date('d', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__d"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__d" style="width:50px;" />
    <?php for ($i = 1; $i <= 31; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"' ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__m', date('m', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__m"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__m" style="width:50px;"/>
    <?php for ($i = 1; $i <= 12; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"'; ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__y', date('Y', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__y"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__y" style="width:100px;"/>
    <?php for ($i = 1900; $i <= date('Y') + 100; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"'; ?>>
	<?php echo $i; ?>
    </option>
<?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__h', date('H', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__h"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__y"
    style="margin-left:20px; width:50px;" />
    <?php for ($i = 0; $i <= 23; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"' ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__i', date('i', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__i"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__i" style="width:50px;" />
    <?php for ($i = 0; $i <= 59; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"' ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
<?php $preset = $this->setPreset('$$$formBit__value__multi__'.$num.'__s', date('s', $value), false); ?>
<select name="$$$formBit__value__multi__<?php echo $num; ?>__s"
    <?php echo $required; ?>
    id="$$$formBit__value__multi__<?php echo $num; ?>__s" style="width:50px;" />
    <?php for ($i = 0; $i <= 59; $i++) { ?>
    <option value="<?php echo $i; ?>"
	<?php if ($preset == $i) echo 'selected="selected"' ?>>
	<?php echo ($i < 10) ? '0'.$i : $i; ?>
    </option>
    <?php } ?>
</select>
	<?php
	break;
    default:
	break;
}

if (substr($typename,0,3) == 'mod') {
    $preset = $this->setPreset('$$$formBit__value__'.$num, $value, false);

    // get objects
    $Obj = $TSunic->get('$bp$Helper');
    $obj_list = $Obj->getObjects($typename);
?>
<select name="$$$formBit__value__<?php echo $num; ?>"
    <?php echo $required; ?>
    id="$$$formBit__value__<?php echo $num; ?>">
    <option value="0"><?php $this->set('{FORMBIT__NOSELECTION}'); ?></option>
    <?php foreach ($obj_list as $index => $Value) { ?>
    <option value="<?php echo $Value->getInfo('id'); ?>"
	<?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
	<?php $this->set($Value->getName()); ?></option>
    <?php } ?>
</select>
<?php } ?>

<?php if ($show_label) { ?>
<div style="clear:both;"></div>
<?php } ?>

<script type="text/javascript">

    // all input-fields in form
    var $$$formSelection__allInputs = new Array();
    $$$formBit__<?php echo $num; ?>__allInputs[0] = new Array('$$$formBit__<?php echo $num; ?>',
	'<?php $this->setjs($Tag->getInfo('title')); ?>',
	'<?php $this->setjs($Tag->getInfo('description')); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$formBit__form'), $$$formBit__<?php echo $num; ?>);
</script>
