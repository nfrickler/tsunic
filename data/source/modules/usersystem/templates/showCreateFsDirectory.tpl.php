<!-- | TEMPLATE show form to create new filesystem directory -->
<div id="$$$div__showCreateFsDirectory">
	<h1><?php $this->set('{SHOWCREATEFSDIRECTORY__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $this->getVar('fk_parent'))); ?>">
			<?php $this->set('{SHOWCREATEFSDIRECTORY__TOPARENT}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWCREATEFSDIRECTORY__INFOTEXT}'); ?>
	</p>

	<?php $this->display('$$$formFsDirectory', array(
		'Directory' => $this->getVar('Directory'),
		'directories' => $this->getVar('directories'),
		'fk_parent' => $this->getVar('fk_parent'),
		'submit_link' => '$$$createFsDirectory',
		'submit_text' => '{SHOWCREATEFSDIRECTORY__SUBMIT}',
		'reset_text' => '{SHOWCREATEFSDIRECTORY__CANCEL}'
	)); ?>
</div>
