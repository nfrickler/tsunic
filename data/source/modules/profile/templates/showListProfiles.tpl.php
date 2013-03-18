<!-- | TEMPLATE show list of all MyProfile objects -->
<div id="$$$div__showListProfiles">
    <?php if ($this->getVar('profiles')) { ?>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{SHOWMYPROFILES__NAME}'); ?></th>
	    <th><?php $this->set('{SHOWMYPROFILES__DATEOFBIRTH}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('profiles') as $index => $Profile) { ?>
	<tr>
	    <td>
		<a href="<?php $this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
		    <?php $this->set($Profile->getName()); ?></a>
	    </td>
	    <?php $this->display('$bp$showBit', array(
		'Bit' => $Profile->getBit('PROFILE__DATEOFBIRTH', true),
		'fk_obj' => $Profile->getInfo('id'),
		'backlink' => base64_encode($this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id')), false, false))
	    )); ?>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p style="margin-top:20px;" class="ts_infotext">
	<?php $this->set('{SHOWLISTPROFILES__NOPROFILES}'); ?>
    </p>
    <?php } ?>
</div>
