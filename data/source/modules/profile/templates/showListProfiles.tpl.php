<!-- | TEMPLATE show list of all myprofiles -->
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
	    <td>
		<?php $Date = $TSunic->get('$calendar$Date', $Profile->getInfo('dateofbirth')); ?>
		<?php $this->set(date('d.m.Y', $Date->getInfo('start'))); ?>
	    </td>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p style="margin-top:20px;" class="ts_infotext">
	<?php $this->set('{SHOWLISTPROFILES__NOPROFILES}'); ?>
    </p>
    <?php } ?>
</div>
