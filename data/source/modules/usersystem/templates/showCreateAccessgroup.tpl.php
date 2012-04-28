<!-- | TEMPLATE show form to create new accessgroup -->
<?php
$Accessgroup = $this->getVar('Accessgroup');
?>
<div id="$$$div__showAccessgroup">
	<h1><?php echo $this->set('{SHOWCREATEACCESSGROUP__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWCREATEACCESSGROUP__INFOTEXT}'); ?>
	</p>

	<?php $this->display('$$$formAccessgroup', array(
		'Accessgroup' => $Accessgroup,
		'accessgroups' => $this->getVar('accessgroups'),
		'submit_link' => '$$$createAccessgroup',
		'submit_text' => '{SHOWCREATEACCESSGROUP__SUBMIT}',
		'reset_text' => '{SHOWCREATEACCESSGROUP__CANCEL}',
		'password_required' => false
	)); ?>
</div>
