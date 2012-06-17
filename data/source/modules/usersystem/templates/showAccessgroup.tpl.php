<!-- | TEMPLATE show accessgroup -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__showAccessgroup">
    <h1><?php $this->set('{SHOWACCESSGROUP__H1}', array('name' => $Accessgroup->getInfo('name'))); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showAccessgroups'); ?>">
	    <?php $this->set('{SHOWACCESSGROUP__TOSHOWACCESSGROUPS}'); ?></a>
	<a href="<?php $this->setUrl('$$$showDeleteAccessgroup', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWACCESSGROUP__TODELETEACCESSGROUP}'); ?></a>
	<a href="<?php $this->setUrl('$$$showAccessgroupmembers', array('$$$id' => $Accessgroup->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWACCESSGROUP__TOSHOWACCESSGROUPMEMBERS}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWACCESSGROUP__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formAccessgroup', array(
	'Accessgroup' => $Accessgroup,
	'accessgroups' => $this->getVar('accessgroups'),
	'submit_link' => '$$$editAccessgroup',
	'submit_text' => '{SHOWACCESSGROUP__SUBMIT}',
	'reset_text' => '{SHOWACCESSGROUP__CANCEL}'
    )); ?>
</div>
