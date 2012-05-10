<!-- | TEMPLATE show content of fs directory -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showFsDirectory">
	<h1><?php $this->set('{SHOWFSDIRECTORY__H1}', array('name' => $Dir->getInfo('name'))); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showCreateFsDirectory', array('fk_parent' => $Dir->getInfo('id'))); ?>">
			<?php $this->set('{SHOWFSDIRECTORY__TOSHOWCREATEFSDIRECTORY}'); ?></a>
		<?php if ($Dir->getInfo('id')) { ?>
		<a href="<?php $this->setUrl('$$$showEditFsDirectory', array('$$$id' => $Dir->getInfo('id'))); ?>">
			<?php $this->set('{SHOWFSDIRECTORY__TOSHOWEDITFSDIRECTORY}'); ?></a>
		<?php } ?>
		<a href="<?php $this->setUrl('$$$showCreateFsFile'); ?>">
			<?php $this->set('{SHOWFSDIRECTORY__TOSHOWCREATEFSFILE}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWFSDIRECTORY__INFOTEXT}'); ?>
	</p>

	<table cellspacing="2" cellpadding="0" border="0">
		<tr>
			<th><?php $this->set('{SHOWFSDIRECTORY__NAME}'); ?></th>
			<!--<th><?php $this->set('{SHOWFSDIRECTORY__PERMISSIONS}'); ?></th>-->
			<th><?php $this->set('{SHOWFSDIRECTORY__DATEOFCREATION}'); ?></th>
			<th><?php $this->set('{SHOWFSDIRECTORY__DATEOFUPDATE}'); ?></th>
			<th><?php $this->set('{SHOWFSDIRECTORY__ACTION}'); ?></th>
		</tr>
		<?php if ($Dir->getInfo('id')) { ?>
		<tr>
			<td><a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $Dir->getInfo('fk_parent'))); ?>"> ../</td>
			<!--<td></td>-->
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?php } ?>
		<?php foreach ($Dir->getSubdirectories() as $index => $Subdir) { ?>
		<tr>
			<td><a href="<?php $this->setUrl('$$$showFsDirectory', array('$$$id' => $Subdir->getInfo('id'))); ?>">
				<?php $this->set($Subdir->getInfo('name')); ?></a></td>
			<!--<td><?php $this->set($Subdir->getInfo('fk_permission')); ?></td>-->
			<td><?php $this->set($Subdir->getInfo('dateOfCreation')); ?></td>
			<td><?php $this->set($Subdir->getInfo('dateOfUpdate')); ?></td>
			<td>
				<a href="<?php $this->setUrl('$$$showDeleteFsDirectory', array('$$$id' => $Subdir->getInfo('id'))); ?>">
					<?php $this->set('{SHOWFSDIRECTORY__DELETE}'); ?></a>
			</td>
		</tr>
		<?php } ?>
		<?php foreach ($Dir->getSubfiles() as $index => $Subfile) { ?>
		<tr>
			<td><a href="<?php $this->setImg('private', $Subfile->getInfo('id'), true ,true); ?>">
				<?php $this->set($Subfile->getInfo('name')); ?></a></td>
			<!--<td><?php $this->set($Subfile->getInfo('fk_permission')); ?></td>-->
			<td><?php $this->set($Subfile->getInfo('dateOfCreation')); ?></td>
			<td><?php $this->set($Subfile->getInfo('dateOfUpdate')); ?></td>
			<td>
				<a href="<?php $this->setUrl('$$$showDeleteFsFile', array('$$$id' => $Subfile->getInfo('id'))); ?>">
					<?php $this->set('{SHOWFSDIRECTORY__DELETE}'); ?></a>
				<a href="<?php $this->setUrl('$$$showEditFsFile', array('$$$id' => $Subfile->getInfo('id'))); ?>">
					<?php $this->set('{SHOWFSDIRECTORY__EDIT}'); ?></a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
