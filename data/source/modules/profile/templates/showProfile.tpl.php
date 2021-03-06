<!-- | TEMPLATE show profile -->
<?php
$Profile = $this->getVar('Profile');
$links = $this->getVar('links');
?>
<div id="$$$div__showProfile">
    <h1><?php $this->set($this->getVar('h1')); ?></h1>
    <p class="ts_suplinkbox">
	<?php if ($Profile->editable()) { ?>
	<a id="$$$showProfile__editlink" href="<?php $this->setUrl('$$$showEditProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TOEDITPROFILE}'); ?></a>
	<a id="$$$showProfile__linklink" href="<?php $this->setUrl('$bp$showLinkObject', array('$bp$fk_obj' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TOLINKOBJECT}'); ?></a>
	<?php if ($this->getVar('showDelete')) { ?>
	<a id="$$$showProfile__deletelink" href="<?php $this->setUrl('$$$showDeleteProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWPROFILE__TODELETEPROFILE}'); ?></a>
	<?php } ?>
	<?php } ?>
    </p>
    <?php if ($this->getVar('infotext')) { ?>
    <p>
	<?php $this->set($this->getVar('infotext')); ?>
    </p>
    <?php } ?>
    <?php if ($Profile->getInfo('mainimage')) { ?>
    <img style="float:right; max-width:350px; max-height:280px;" src="<?php $this->setImg('private', $Profile->getInfo('mainimage')); ?>" />
    <?php } ?>
    <table cellspacing="2" cellpadding="0" border="0" style="width:50%">
	<?php if ($Profile->getAccount()) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{TAG__PROFILE__ACCOUNT}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Profile->getAccount()->getName()); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Profile->getInfo('firstname') or $Profile->getInfo('lastname')) { ?>
	<tr>
	    <th style="min-width:100px;"><?php $this->set('{SHOWPROFILE__NAME}'); ?></th>
	    <td style="min-width:100px;">
		<?php $this->set($Profile->getInfo('firstname')." ".$Profile->getInfo('lastname')); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Profile->get2show('PROFILE__GENDER')) { ?>
	<tr>
	    <th><?php $this->set('{SHOWPROFILE__GENDER}'); ?></th>
	    <td>
		<?php $this->set($Profile->get2show('PROFILE__GENDER')); ?>
	    </td>
	</tr>
	<?php } ?>
	<?php if ($Profile->getInfo('dateofbirth')) { ?>
	<tr>
	    <th style="min-width:100px;">
		<?php $this->set('{TAG__PROFILE__DATEOFBIRTH}'); ?></th>
	    </th>
	    <?php
	    $this->display('$bp$showBit', array(
		'Bit' => $Profile->getBit('PROFILE__DATEOFBIRTH', true),
		'fk_obj' => $Profile->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id')), false, false))
	    ));
	    ?>
	</tr>
	<?php } ?>

	<?php if ($Profile->getInfo('mainimage')) { ?>
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
	<?php } ?>
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

    <?php if (!empty($links)) { ?>
    <h3><?php $this->set('{SHOWPROFILE__H1_LINKS}'); ?></h3>
    <?php
    $this->display('$bp$showListLinks', array(
	'links' => $this->getVar('links'),
	'object' => $this->getVar('Profile'),
    ));
    ?>
    <?php } ?>
</div>
