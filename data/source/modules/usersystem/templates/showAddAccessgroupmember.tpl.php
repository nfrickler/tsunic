<!-- | TEMPLATE show form to add member to accessgroup -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__showAddAccessgroupmember">
    <h1><?php $this->set('{SHOWADDACCESSGROUPMEMBER__H1}', array('name' => $Accessgroup->getInfo('name'))); ?></h1>
    <p class="ts_infotext">
	<?php $this->set('{SHOWADDACCESSGROUPMEMBER__INFOTEXT}'); ?>
    </p>

    <form action="<?php $this->setUrl('$$$addAccessgroupmember'); ?>" method="post" name="$$$showAddAccessgroupmember__form" id="$$$showAddAccessgroupmember__form" class="ts_form">
	<fieldset>
	    <legend><?php $this->set('{SHOWADDACCESSGROUPMEMBER__LEGEND}'); ?></legend>
	    <input type="hidden" name="$$$showAddAccessgroupmember__id" id="$$$showAddAccessgroupmember__id" value="<?php echo $Accessgroup->getInfo('id'); ?>" />
	    <label for="$$$showAddAccessgroupmember__user"><?php $this->set('{SHOWADDACCESSGROUPMEMBER__USER}'); ?></label>
	    <select class="ts_required" name="$$$showAddAccessgroupmember__user" id="$$$showAddAccessgroupmember__user">
		<?php foreach ($this->getVar('users') as $id => $name) { ?>
		<option value="<?php echo $id; ?>" <?php if ($this->setPreset('$$$showAddAccessgroupmember__user', false, false) == $id) echo 'selected="selected"'; ?>>
		    <?php $this->set($name); ?>
		</option>
		<?php } ?>
	    </select>
	    <div style="clear:both;"></div>
	</fieldset>
	<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWADDACCESSGROUPMEMBER__SUBMIT}'); ?>" />
	<a class="ts_reset" href="<?php $this->setUrl('$$$showAccessgroupmembers', array('$$$id' => $Accessgroup->getInfo('id'))); ?>"><?php $this->set('{SHOWADDACCESSGROUPMEMBER__CANCEL}'); ?></a>
    </form>
</div>
<script type="text/javascript">
    // all input-fields in form
    var $$$showAddAccessgroupmember__allInputs = new Array();
    $$$showAddAccessgroupmember__allInputs[0] = new Array('$$$showAddAccessgroupmember__user',
	'',
	'<?php $this->setjs('{SHOWADDACCESSGROUPMEMBER__USER_HELP}'); ?>');

    // add help to form
    $system$showFormHelp(document.getElementById('$$$showAddAccessgroupmember__form'), $$$showAddAccessgroupmember__allInputs);
</script>
