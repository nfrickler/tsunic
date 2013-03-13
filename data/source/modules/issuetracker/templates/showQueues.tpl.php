<!-- | TEMPLATE show queues -->
<div id="$$$div__showQueues">
    <h1><?php $this->set('{SHOWQUEUES__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateQueue'); ?>">
	    <?php $this->set('{SHOWQUEUES__TOCREATEQUEUE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWQUEUES__INFOTEXT}'); ?>
    </p>

    <?php if ($this->getVar('queues')) { ?>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{TAG__QUEUE__NAME}'); ?></th>
	    <th><?php $this->set('{TAG__QUEUE__DESCRIPTION}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('queues') as $index => $Queue) { ?>
	<tr>
	    <td>
		<a href="<?php $this->setUrl('$$$showQueue', array('$$$id' => $Queue->getInfo('id'))); ?>">
		    <?php $this->set($Queue->getInfo('name')); ?></a>
	    </td>
	    <td>
		<?php $this->set($Queue->getInfo('description')); ?>
	    </td>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p style="margin-top:20px;" class="ts_infotext"><?php $this->set('{SHOWQUEUES__NOQUEUE}'); ?></p>
    <?php } ?>
</div>
