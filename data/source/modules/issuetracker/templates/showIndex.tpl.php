<!-- | TEMPLATE show index -->
<div id="$$$div__showIndex">
    <h1><?php $this->set('{SHOWINDEX__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showCreateIssue'); ?>">
	    <?php $this->set('{SHOWINDEX__TOCREATEISSUE}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWINDEX__INFOTEXT}'); ?>
    </p>

    <?php if ($this->getVar('issues')) { ?>
    <table cellspacing="2" cellpadding="0" border="0">
	<tr>
	    <th><?php $this->set('{TAG__ISSUE__NAME}'); ?></th>
	    <th><?php $this->set('{TAG__ISSUE__AUTHOR}'); ?></th>
	    <th><?php $this->set('{TAG_ISSUE__DESCRIPTION}'); ?></th>
	</tr>
	<?php foreach ($this->getVar('issues') as $index => $Issue) { ?>
	<tr>
	    <td>
		<a href="<?php $this->setUrl('$$$showIssue', array('$$$id' => $Issue->getInfo('id'))); ?>">
		    <?php $this->set($Issue->getInfo('name')); ?></a>
	    </td>
	    <td>
		<?php $Author = $TSunic->get('$profile$MyProfile', $Issue->getInfo('author')); ?>
		<a href="<?php $this->setUrl('$profile$showMyProfile', array('$profile$id' => $Author->getInfo('id'))); ?>">
		    <?php $this->set($Author->getName()); ?></a>
	    </td>
	    <td>
		<?php $this->set($Issue->getInfo('description')); ?>
	    </td>
	</tr>
	<?php } ?>
    </table>
    <?php } else { ?>
    <p style="margin-top:20px;" class="ts_infotext"><?php $this->set('{SHOWINDEX__NOISSUES}'); ?></p>
    <?php } ?>
</div>
