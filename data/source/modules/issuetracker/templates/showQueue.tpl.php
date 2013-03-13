<!-- | TEMPLATE show queue -->
<?php $Queue = $this->getVar('Queue'); ?>
<div id="$$$div__showQueue">
    <h1><?php $this->set($this->getVar('h1')); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showQueue__editlink" href="<?php $this->setUrl('$$$showEditQueue', array('$$$id' => $Queue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWQUEUE__TOEDITQUEUE}'); ?></a>
	<a id="$$$showQueue__deletelink" href="<?php $this->setUrl('$$$showDeleteQueue', array('$$$id' => $Queue->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWQUEUE__TODELETEQUEUE}'); ?></a>
    </p>
    <?php if ($this->getVar('infotext')) { ?>
    <p>
	<?php $this->set($this->getVar('infotext')); ?>
    </p>
    <?php } ?>
    <?php if ($Queue->getInfo('mainimage')) { ?>
    <img style="float:right; max-width:350px; max-height:280px;" src="<?php $this->setImg('private', $Queue->getInfo('mainimage')); ?>" />
    <?php } ?>
    <table cellspacing="2" cellpadding="0" border="0" style="width:50%">
	<?php if ($Queue->getInfo('name')) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{TAG__QUEUE__NAME}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Queue->getInfo('name')); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Queue->getInfo('description')) { ?>
	<tr>
	    <th><?php $this->set('{TAG__QUEUE__DESCRIPTION}'); ?></th>
	    <td>
		<?php $this->set($Queue->getInfo('description')); ?>
	    </td>
	</tr>
	<?php } ?>
    </table>

    <table cellspacing="2" cellpadding="0" border="0">
	<?php foreach ($Queue->getBits(false) as $index => $Value) { ?>
	<tr>
	    <th style="min-width:100px;">
		<?php $this->set($Value->getTag()->getInfo('title')); ?></th>
	    </th>
	    <?php
	    $this->display('$bp$showBit', array(
		'Bit' => $Value,
		'fk_obj' => $Queue->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showQueue', array('$$$id' => $Queue->getInfo('id')), false, false))
	    ));
	    ?>
	</tr>
	<?php } ?>
    </table>
</div>
