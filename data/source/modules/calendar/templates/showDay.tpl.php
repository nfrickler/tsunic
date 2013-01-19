<!-- | TEMPLATE show day -->
<div id="$$$div__showDay">
    <h1><?php $this->set('{SHOWDAY__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateDate'); ?>">
	    <?php $this->set('{SHOWDAY__TOCREATEDATE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWDAY__INFOTEXT}'); ?>
    </p>

    <table cellspacing="0" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{SHOWDAY__TIME}'); ?></th>
	    <th><?php $this->set('{SHOWDAY__TITLE}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('dates') as $index => $Value) { ?>
	<tr>
	    <td><?php echo date('H:i', $Value->getInfo('start')).'-'.date('H:i', $Value->getInfo('stop')); ?></td>
	    <td><?php $this->set($Value->getInfo('title')); ?></td>
	</tr>
	<?php } ?>
    </table>
</div>
