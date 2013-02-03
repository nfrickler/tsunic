<!-- | TEMPLATE show day -->
<?php $time = $this->getVar('time'); ?>
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
	    <th style="width:20px;"><a href="<?php $this->setUrl('$$$showDay', array('$$$time' => $time - 24 * 3600)); ?>">&lt;&lt;&lt;</a></th>
	    <th style="text-align:center;"><a href="<?php $this->setUrl('$$$showMonth', array('$$$time' => $time)); ?>"><?php echo date('d.m.Y', $time); ?></a></th>
	    <th style="width:20px;"><a href="<?php $this->setUrl('$$$showDay', array('$$$time' => $time + 24 * 3600)); ?>">&gt;&gt;&gt;</a></th>
	</tr>
    </table>

    <?php if ($this->getVar('dates')) { ?>
    <table cellspacing="0" cellpadding="0" border="0">
	<tr>
	    <th style="width:15%;"><?php $this->set('{SHOWDAY__TIME}'); ?></th>
	    <th><?php $this->set('{SHOWDAY__TITLE}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('dates') as $index => $values) { ?>
	<tr>
	    <td><?php echo date('H:i', $values['time']).'-'.date('H:i', $values['Date']->getStop($values['time'])); ?></td>
	    <td><a href="<?php $this->setUrl('$$$showEditDate', array('$$$id' => $values['Date']->getInfo('id'))); ?>"><?php $this->set($values['Date']->getInfo('title')); ?></a></td>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p style="margin-top:20px;" class="ts_infotext"><?php $this->set('{SHOWDAY__NODATES}'); ?></p>
    <?php } ?>
</div>
