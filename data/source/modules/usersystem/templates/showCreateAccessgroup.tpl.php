<!-- | TEMPLATE show form to create new accessgroup -->
<div id="$$$div__showCreateAccessgroup">
    <h1><?php $this->set('{SHOWCREATEACCESSGROUP__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showAccessgroups'); ?>">
	    <?php $this->set('{SHOWCREATEACCESSGROUP__TOACCESSGROUPS}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWCREATEACCESSGROUP__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formAccessgroup', array(
	'Accessgroup' => $this->getVar('Accessgroup'),
	'accessgroups' => $this->getVar('accessgroups'),
	'submit_link' => '$$$createAccessgroup',
	'submit_text' => '{SHOWCREATEACCESSGROUP__SUBMIT}',
	'reset_text' => '{SHOWCREATEACCESSGROUP__CANCEL}'
    )); ?>
</div>
