<!-- | TEMPLATE show tags -->
<div id="$$$div__showTags">
    <h1><?php $this->set('{SHOWTAGS__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateTag'); ?>">
	    <?php $this->set('{SHOWTAGS__TOCREATETAG}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWTAGS__INFOTEXT}'); ?>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{SHOWTAGS__NAME}'); ?></th>
	    <th><?php $this->set('{SHOWTAGS__DESCRIPTION}'); ?></th>
	    <th><?php $this->set('{SHOWTAGS__ACTIONS}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('tags') as $index => $Tag) { ?>
	<tr>
	    <td>
		<a href="<?php $this->setUrl('$$$showEditTag', array('$$$id' => $Tag->getInfo('id'))); ?>">
		    <?php $this->set($Tag->getInfo('name')); ?></a>
	    </td>
	    <td>
		<?php $this->set($Tag->getInfo('description')); ?>
	    </td>
	    <td>
		<a href="<?php $this->setUrl('$$$showDeleteTag', array('$$$id' => $Tag->getInfo('id'))); ?>">
		    <?php $this->set('{SHOWTAGS__TODELETE}'); ?></a>
	    </td>
	</tr>
	<?php } ?>
    </table>
</div>
