<!-- | TEMPLATE show month -->
<?php
$time = $this->getVar('time');
?>
<div id="$$$div__showMonth">
    <h1><?php $this->set('{SHOWMONTH__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateDate'); ?>">
	    <?php $this->set('{SHOWMONTH__TOCREATEDATE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWMONTH__INFOTEXT}'); ?>
    </p>

    <table cellspacing="0" cellpadding="0" border="0">
	<tr>
	    <th style="width:20px;"><a href="<?php $this->setUrl('$$$showMonth', array('$$$time' => strtotime('-1 month', $time))); ?>">&lt;&lt;&lt;</a></th>
	    <th style="text-align:center;"><a href="<?php $this->setUrl('$$$showMonth', array('$$$time' => $time)); ?>"><?php echo date('m.Y', $time); ?></a></th>
	    <th style="width:20px;"><a href="<?php $this->setUrl('$$$showMonth', array('$$$time' => strtotime('+1 month', $time))); ?>">&gt;&gt;&gt;</a></th>
	</tr>
    </table>

    <table cellspacing="0" cellpadding="0" border="0">
	<tr>
	    <th style="width:5%;"><?php $this->set('{SHOWMONTH__DAY}'); ?></th>
	    <th style="width:15%;"><?php $this->set('{SHOWMONTH__TIME}'); ?></th>
	    <th><?php $this->set('{SHOWMONTH__TITLE}'); ?></th>
	</tr>

	<?php $day_dates = array(); ?>
	<?php foreach ($this->getVar('dates') as $index => $values) { ?>
	<tr>
	    <td rowspan="<?php echo count($values); ?>"><a href="<?php $this->setUrl('$$$showDay', array('$$$time' => $values[0]['time'])); ?>"><?php $this->set($index); ?></a></td>
	    <td><?php echo date('H:i', $values[0]['time']).'-'.date('H:i', $values[0]['Date']->getStop($values[0]['time'])); ?></td>
	    <td><a href="<?php $this->setUrl('$$$showEditDate', array('$$$id' => $values[0]['Date']->getInfo('id'))); ?>"><?php $this->set($values[0]['Date']->getInfo('title')) ?></a></td>
	</tr>
	<?php foreach ($values as $in => $val) { ?>
	<?php if ($in == 0) continue; ?>
	<tr>
	    <td><?php echo date('H:i', $val['time']).'-'.date('H:i', $val['Date']->getStop($val['time'])); ?></td>
	    <td><a href="<?php $this->setUrl('$$$showEditDate', array('$$$id' => $val['Date']->getInfo('id'))); ?>"><?php $this->set($val['Date']->getInfo('title')) ?></a></td>
	</tr>
	<?php } ?>
	<?php } ?>
    </table>
</div>
