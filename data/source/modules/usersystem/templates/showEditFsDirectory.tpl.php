<!-- | TEMPLATE show form to edit filesystem directory -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showEditFsDirectory">
	<h1><?php $this->set('{SHOWEDITFSDIRECTORY__H1}', array('name' => $Dir->getInfo('name'))); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
			<?php $this->set('{SHOWEDITFSDIRECTORY__TOPARENT}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWEDITFSDIRECTORY__INFOTEXT}'); ?>
	</p>

	<?php $this->display('$$$formFsDirectory', array(
		'Directory' => $Dir,
		'directories' => $this->getVar('directories'),
		'submit_link' => '$$$editFsDirectory',
		'submit_text' => '{SHOWEDITFSDIRECTORY__SUBMIT}',
		'reset_text' => '{SHOWEDITFSDIRECTORY__CANCEL}'
	)); ?>
</div>
