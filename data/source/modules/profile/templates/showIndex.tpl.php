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
		<?php
		$name = $Profile->getInfo('firstname').' '.
		    $Profile->getInfo('lastname');
		if (empty($name)) $name = "{SHOWINDEX__UNKNOWNNAME}";
		?>
		<a href="<?php $this->setUrl('$$$showProfile', array('$$$id' => $Profile->getInfo('id'))); ?>">
		    <?php $this->set($name); ?></a>
	    </td>
	    <td><?php $this->set($Profile->getInfo('dateofbirth')); ?></td>
	</tr>
	<?php } ?>
    </table>
</div>
