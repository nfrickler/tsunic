<!-- | TEMPLATE show profile -->
<?php $Profile = $this->getVar('Profile'); ?>
<div id="$$$div__showProfile">
    <h1><?php $this->set('{SHOWPROFILE__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a id="$$$showProfile__editlink" href="<?php $this->setUrl('$$$showEditProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TOEDITPROFILE}'); ?></a>
	<a id="$$$showProfile__deletelink" href="<?php $this->setUrl('$$$showDeleteProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TODELETEPROFILE}'); ?></a>
    </p>
    <?php if ($Profile->getInfo('mainimage')) { ?>
    <img style="float:right; max-width:350px; max-height:280px;" src="<?php $this->setImg('private', $Profile->getInfo('mainimage')); ?>" />
    <?php } ?>
    <table cellspacing="2" cellpadding="0" border="0" style="width:50%">
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{SHOWPROFILE__NAME}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Profile->getInfo('firstname')." ".$Profile->getInfo('lastname')); ?>
	    </td>
	</tr>
	<tr>
	    <th><?php $this->set('{SHOWPROFILE__GENDER}'); ?></th>
	    <td>
		<?php $this->set($Profile->get2show('PROFILE__GENDER')); ?>
	    </td>
	</tr>
	<tr>
	    <th><?php $this->set('{SHOWPROFILE__DATEOFBIRTH}'); ?></th>
	    <td>
		<?php $this->set(date('d.m.Y', $this->getVar('Date')->getInfo('start'))); ?>
	    </td>
	</tr>
	<tr>
	    <th><?php $this->set('{TAG__PROFILE__MAINIMAGE}'); ?></th>
	    <?php
	    $this->display('$bp$showBit', array(
		'Bit' => $Profile->getBit('PROFILE__MAINIMAGE', true),
		'fk_obj' => $Profile->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id')), false, false))
	    ));
	    ?>
	<tr>
    </table>

    <table cellspacing="2" cellpadding="0" border="0">
	<?php foreach ($Profile->getBits(false) as $index => $Value) { ?>
	<tr>
	    <th style="min-width:100px;">
		<?php $this->set($Value->getTag()->getInfo('title')); ?></th>
	    </th>
	    <?php
	    $this->display('$bp$showBit', array(
		'Bit' => $Value,
		'fk_obj' => $Profile->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id')), false, false))
	    ));
	    ?>
	</tr>
	<?php } ?>
    </table>
</div>
