<!-- | TEMPLATE show index -->
<div id="$$$div__showIndex">
    <h1><?php $this->set('{SHOWINDEX__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateProfile'); ?>">
	    <?php $this->set('{SHOWINDEX__TOCREATEPROFILE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWINDEX__INFOTEXT}'); ?>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{SHOWINDEX__NAME}'); ?></th>
	    <th><?php $this->set('{SHOWINDEX__DATEOFBIRTH}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('profiles') as $index => $Profile) { ?>
	<tr>
	    <td>
		<?php $this->set($Profile->getInfo('firstname')); ?>
		<?php $this->set($Profile->getInfo('lastname')); ?>
	    </td>
	    <td><?php $this->set($Profile->getInfo('dateOfBirth')); ?></td>
	</tr>
	<?php } ?>
    </table>
</div>
