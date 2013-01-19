<!-- | TEMPLATE show form for date -->
<?php
$Date = $this->getVar('Date');
$num = 0;
?>
<div id="$$$div__formDate">
    <form action="<?php $this->setUrl($this->getVar('submit_link')); ?>" method="post" name="$$$formDate__form" id="$$$formDate__form" class="ts_form">
	<input type="hidden" name="$$$formDate__id" id="$$$formDate__id" value="<?php echo $Date->getInfo('id'); ?>" />
	<fieldset>
	    <legend><?php $this->set('{FORMDATE__LEGEND_ID}'); ?></legend>

	    <label for="$$$formDate__title"><?php $this->set('{TAG__DATE__TITLE}'); ?></label>
	    <input class="ts_required" type="text" name="$$$formDate__title" id="$$$formDate__title" value="<?php $this->setPreset('$$$formDate__title', $Date->getInfo('title')); ?>" />
	    <div style="clear:both;"></div>

	    <label for="$$$formDate__start_d"><?php $this->set('{TAG__DATE__START}'); ?></label>
	    <?php $preset = $this->setPreset('$$$formDate__start_d', date('d', $Date->getInfo('start')), false); ?>
	    <select class="ts_required" name="$$$formDate__start_d" id="$$$formDate__start_d" style="width:50px;" />
		<?php for ($i = 1; $i <= 31; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__start_m', date('m', $Date->getInfo('start')), false); ?>
	    <select class="ts_required" name="$$$formDate__start_m" id="$$$formDate__start_m" style="width:50px;"/>
		<?php for ($i = 1; $i <= 12; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php
	    $preset = $Date->getInfo('start') || time();
	    $preset = $this->setPreset('$$$formDate__start_y', date('Y', $preset), false);
	    ?>
	    <select class="ts_required" name="$$$formDate__start_y" id="$$$formDate__start_y" style="width:100px;"/>
		<?php for ($i = 1900; $i <= date('Y') + 100; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
		<?php } ?>
	    </select>
	    <?php
	    $preset = ($Date->getInfo('start')) ? date('H', $Date->getInfo('start')) : 0; // date('H', 0) == 1
	    $preset = $this->setPreset('$$$formDate__start_H', $preset, false);
	    ?>
	    <select class="ts_required" name="$$$formDate__start_H" id="$$$formDate__start_H" style="margin-left:20px; width:50px;" />
		<?php for ($i = 0; $i <= 23; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__start_i', date('i', $Date->getInfo('start')), false); ?>
	    <select class="ts_required" name="$$$formDate__start_i" id="$$$formDate__start_i" style="width:50px;" />
		<?php for ($i = 0; $i <= 59; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__start_s', date('s', $Date->getInfo('start')), false); ?>
	    <select class="ts_required" name="$$$formDate__start_s" id="$$$formDate__start_s" style="width:50px;" />
		<?php for ($i = 0; $i <= 59; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>

	    <label for="$$$formDate__stop_d"><?php $this->set('{TAG__DATE__STOP}'); ?></label>
	    <?php $preset = $this->setPreset('$$$formDate__stop_d', date('d', $Date->getInfo('stop')), false); ?>
	    <select class="ts_required" name="$$$formDate__stop_d" id="$$$formDate__stop_d" style="width:50px;" />
		<?php for ($i = 1; $i <= 31; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__stop_m', date('m', $Date->getInfo('stop')), false); ?>
	    <select class="ts_required" name="$$$formDate__stop_m" id="$$$formDate__stop_m" style="width:50px;" />
		<?php for ($i = 1; $i <= 12; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php
	    $preset = $Date->getInfo('stop') || time();
	    $preset = $this->setPreset('$$$formDate__stop_y', date('Y', $preset), false);
	    ?>
	    <select class="ts_required" name="$$$formDate__stop_y" id="$$$formDate__stop_y" style="width:100px;" />
		<?php for ($i = 1900; $i <= date('Y') + 100; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
		<?php } ?>
	    </select>

	    <?php
	    $preset = ($Date->getInfo('stop')) ? date('H', $Date->getInfo('stop')) : 0; // date('H', 0) == 1
	    $preset = $this->setPreset('$$$formDate__stop_H', $preset, false);
	    ?>
	    <select class="ts_required" name="$$$formDate__stop_H" id="$$$formDate__stop_H" style="margin-left:20px; width:50px;" />
		<?php for ($i = 0; $i <= 23; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__stop_i', date('i', $Date->getInfo('stop')), false); ?>
	    <select class="ts_required" name="$$$formDate__stop_i" id="$$$formDate__stop_i" style="width:50px;" />
		<?php for ($i = 0; $i <= 59; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <?php $preset = $this->setPreset('$$$formDate__stop_s', date('s', $Date->getInfo('stop')), false); ?>
	    <select class="ts_required" name="$$$formDate__stop_s" id="$$$formDate__stop_s" style="width:50px;" />
		<?php for ($i = 0; $i <= 59; $i++) { ?>
		<option value="<?php echo $i; ?>" <?php if ($preset == $i) echo 'selected="selected"' ?>><?php echo ($i < 10) ? '0'.$i : $i; ?></option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>

	    <label for="$$$formDate__period"><?php $this->set('{TAG__DATE__PERIOD}'); ?></label>
	    <input class="ts_required" type="text" name="$$$formDate__period" id="$$$formDate__period" value="<?php $this->setPreset('$$$formDate__period', $Date->getInfo('period')); ?>" style="width:100px;" />
	    <?php
	    $preset = $this->setPreset('$$$formDate__periodtype', $Date->getInfo('periodtype'), false);
	    $Tag = $TSunic->get('$bp$Tag', $Date->tag2id('DATE__PERIODTYPE'));
	    ?>
	    <select class="ts_required" name="$$$formDate__periodtype" id="$$$formDate__periodtype" style="width:300px;">
		<?php foreach ($Tag->getSelections() as $index => $Value) { ?>
		<option value="<?php echo $Value->getInfo('id'); ?>" <?php if ($Value->getInfo('id') == $preset) echo 'selected="selected"'; ?>>
		    <?php $this->set($Value->getInfo('name')); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
	</fieldset>
	<?php if ($Date->getBits(false)) { ?>
	<fieldset>
	    <legend><?php $this->set('{FORMDATE__LEGEND}'); ?></legend>
	    <?php
	    foreach ($Date->getBits(false) as $index => $Value) {
		$this->display('$bp$formBit', array(
		    'Bit' => $Value,
		    'num' => $num++,
		));
	    }
	    ?>
	</fieldset>
	<?php } ?>
	<input type="submit" class="ts_submit" value="<?php $this->set('#submit_text#'); ?>" />
	<?php if ($this->getVar('reset_text')) { ?>
	<a href="<?php $this->setUrl('back'); ?>" class="ts_reset">
	    <?php $this->set('#reset_text#'); ?></a>
	<?php } ?>
    </form>
</div>
