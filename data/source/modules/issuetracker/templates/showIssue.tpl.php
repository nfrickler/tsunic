<!-- | TEMPLATE show issue -->
<?php $Issue = $this->getVar('Issue'); ?>
<div id="$$$div__showIssue">
    <h1><?php $this->set($this->getVar('h1')); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showIssue__editlink" href="<?php $this->setUrl('$$$showEditIssue', array('$$$id' => $Issue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWISSUE__TOEDITISSUE}'); ?></a>
	<?php if ($this->getVar('showDelete')) { ?>
	<a id="$$$showIssue__deletelink" href="<?php $this->setUrl('$$$showDeleteIssue', array('$$$id' => $Issue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWISSUE__TODELETEISSUE}'); ?></a>
	<?php } ?>
    </p>
    <?php if ($this->getVar('infotext')) { ?>
    <p>
	<?php $this->set($this->getVar('infotext')); ?>
    </p>
    <?php } ?>
    <?php if ($Issue->getInfo('mainimage')) { ?>
    <img style="float:right; max-width:350px; max-height:280px;" src="<?php $this->setImg('private', $Issue->getInfo('mainimage')); ?>" />
    <?php } ?>
    <table cellspacing="2" cellpadding="0" border="0" style="width:50%">
	<?php if ($Issue->getInfo('name')) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{SHOWISSUE__NAME}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Issue->getInfo('name')); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Issue->getInfo('author')) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{SHOWISSUE__AUTHOR}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Issue->getInfo('author')); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Issue->getInfo('description')) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{SHOWISSUE__DESCRIPTION}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Issue->getInfo('description')); ?>
	    </td>
	</tr>
	<?php } ?>
    </table>

    <table cellspacing="2" cellpadding="0" border="0">
	<?php foreach ($Issue->getBits(false) as $index => $Value) { ?>
	<tr>
	    <th style="min-width:100px;">
		<?php $this->set($Value->getTag()->getInfo('title')); ?></th>
	    </th>
	    <?php
	    $this->display('$bp$showBit', array(
		'Bit' => $Value,
		'fk_obj' => $Issue->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showIssue', array('$$$id' => $Issue->getInfo('id')), false, false))
	    ));
	    ?>
	</tr>
	<?php } ?>
    </table>
</div>
