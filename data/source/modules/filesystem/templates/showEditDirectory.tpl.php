<!-- | TEMPLATE show form to edit filesystem directory -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showEditDirectory">
    <h1><?php $this->set('{SHOWEDITDIRECTORY__H1}', array('name' => $Dir->getInfo('name'))); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWEDITDIRECTORY__TOPARENT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWEDITDIRECTORY__INFOTEXT}'); ?>
    </p>

    <?php $this->display('$$$formDirectory', array(
	'Directory' => $Dir,
	'showParent' => true,
	'submit_link' => '$$$editDirectory',
	'submit_text' => '{SHOWEDITDIRECTORY__SUBMIT}',
	'reset_text' => '{SHOWEDITDIRECTORY__CANCEL}'
    )); ?>
</div>
