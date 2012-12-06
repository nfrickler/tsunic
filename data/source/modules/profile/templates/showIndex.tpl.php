<!-- | TEMPLATE show index -->
<div id="$$$div__showIndex">
    <h1><?php echo $this->set('{SHOWINDEX__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateProfile'); ?>">
	    <?php $this->set('{SHOWINDEX__TOEDITPROFILE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWINDEX__INFOTEXT}'); ?>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php echo $this->set('{SHOWINDEX__NAME}'); ?></th>
	    <th><?php echo $this->set('{SHOWINDEX__DATEOFBIRTH}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('profiles') as $index => $Profile) { ?>
	<tr>
	    <td><?php $this->set($Profile->getInfo('firstname')); ?></td>
	</tr>
    </table>
</div>
