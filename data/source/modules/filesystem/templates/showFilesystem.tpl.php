<!-- | TEMPLATE show filesystem -->
<?php
$Dir = $this->getVar('Directory');
?>
<div id="$$$div__showFilesystem">
    <h1><?php $this->set('{SHOWFILESYSTEM__H1}', array('name' => ($Dir->getPath()) ? $Dir->getPath() : "/")); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateFsFile', array('fk_directory' => $Dir->getPath())); ?>">
	    <?php $this->set('{SHOWFILESYSTEM__TOSHOWCREATEFSFILE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWFILESYSTEM__INFOTEXT}'); ?>
    </p>

    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{SHOWFILESYSTEM__NAME}'); ?></th>
	    <!--<th><?php $this->set('{SHOWFILESYSTEM__PERMISSIONS}'); ?></th>-->
	    <th><?php $this->set('{SHOWFILESYSTEM__DATEOFCREATION}'); ?></th>
	    <th><?php $this->set('{SHOWFILESYSTEM__DATEOFUPDATE}'); ?></th>
	    <th><?php $this->set('{SHOWFILESYSTEM__ACTION}'); ?></th>
	</tr>
	<?php if ($Dir->getPath()) { ?>
	<tr>
	    <td><a href="<?php $this->setUrl('$$$showFilesystem', array('$$$path' => $Dir->getSupPath())); ?>"> ../</a></td>
	    <!--<td></td>-->
	    <td></td>
	    <td></td>
	    <td></td>
	</tr>
	<?php } ?>
	<?php foreach ($Dir->getSubdirectories() as $index => $value) { ?>
	<tr>
	    <td><a href="<?php $this->setUrl('$$$showFilesystem', array('$$$path' => $value)); ?>">
		<?php $this->set($index); ?></a></td>
	    <td></td>
	    <td></td>
	    <td></td>
	</tr>
	<?php } ?>
	<?php foreach ($Dir->getSubfiles() as $index => $Subfile) { ?>
	<tr>
	    <td><a href="<?php $this->setImg('private', $Subfile->getInfo('id'), true ,true); ?>">
		<?php $this->set($Subfile->getFilename()); ?></a></td>
	    <!--<td><?php $this->set($Subfile->getInfo('fk_permission')); ?></td>-->
	    <td><?php $this->set($Subfile->getInfo('dateOfCreation')); ?></td>
	    <td><?php $this->set($Subfile->getInfo('dateOfUpdate')); ?></td>
	    <td>
		<a href="<?php $this->setUrl('$$$showDeleteFsFile', array('$$$id' => $Subfile->getInfo('id'))); ?>">
		    <?php $this->set('{SHOWFILESYSTEM__DELETE}'); ?></a>
		<a href="<?php $this->setUrl('$$$showEditFsFile', array('$$$id' => $Subfile->getInfo('id'))); ?>">
		    <?php $this->set('{SHOWFILESYSTEM__EDIT}'); ?></a>
	    </td>
	</tr>
	<?php } ?>
    </table>
</div>
