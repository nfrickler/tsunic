<!-- | Template: show mail account -->
<?php
// add javascript
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="$$$div__showMailaccount">
    <h1><?php $this->set('{SHOWMAILACCOUNT__H1}'); ?></h1>
    <p class="ts_suplinkbox">
	<a href="<?php $this->setUrl('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id'))); ?>"><?php $this->set('{SHOWMAILACCOUNT__TOEDITMAILACCOUNT}'); ?></a>
	<a href="<?php $this->setUrl('$$$showDeleteMailaccount', array('$$$id' => $Mailaccount->getInfo('id'))); ?>"><?php $this->set('{SHOWMAILACCOUNT__TODELETEMAILACCOUNT}'); ?></a>
    </p>
    <p class="ts_infotext">
	<?php $this->set('{SHOWMAILACCOUNT__INFOTEXT}'); ?>
    </p>
    <table cellspacing="2" cellpadding="0" border="0">
	<?php if ($name = $Mailaccount->getInfo('name') AND !empty($name)) { ?>
	<tr>
	    <th style="min-width:200px;"><?php echo $this->set('{SHOWMAILACCOUNT__NAME}'); ?></th>
	    <td style="min-width:200px;" id="$$$showMailaccount__name"><?php $this->set($Mailaccount->getInfo('name')); ?></td>
	</tr>
	<?php } ?>
	<?php if ($description = $Mailaccount->getInfo('description') AND !empty($description)) { ?>
	<tr>
	    <th><?php echo $this->set('{SHOWMAILACCOUNT__DESCRIPTION}'); ?></th>
	    <td id="$$$showMailaccount__description"><?php $this->set($Mailaccount->getInfo('description')); ?></td>
	</tr>
	<?php } ?>
	<tr>
	    <th><?php echo $this->set('{SHOWMAILACCOUNT__EMAIL}'); ?></th>
	    <td id="$$$showMailaccount__email"><?php $this->set($Mailaccount->getInfo('email')); ?></td>
	</tr>
	<tr>
	    <th><?php echo $this->set('{SHOWMAILACCOUNT__DATEOFCREATION}'); ?></th>
	    <td id="$$$showMailaccount__dateOfCreation"><?php $this->set($Mailaccount->getInfo('dateOfCreation')); ?></td>
	</tr>
    </table>

    <h2 style="margin-top:15px;"><?php $this->set('{SHOWMAILACCOUNT__SERVERBOXES_H1}'); ?></h2>
    <p class="ts_infotext"><?php $this->set('{SHOWMAILACCOUNT__SERVERBOXES_INFO}'); ?></p>
    <form action="<?php $this->setUrl('$$$activateServerboxes'); ?>" name="$$$showMailaccount__serverboxes_form" method="post">
	<input type="hidden" name="$$$id" value="<?php $this->set($Mailaccount->getInfo('id')); ?>" />
	<?php $this->display('$$$showListServerboxes', array(
	    'serverboxes' => $Mailaccount->getServerboxes(),
	    'selectable' => '$$$showMailaccount__serverboxes_'
	)); ?>
	<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWMAILACCOUNT__SERVERBOXES_SUBMIT}'); ?>" />
    </form>
    <p class="ts_sublinkbox">
	<a href="<?php $this->setUrl('$$$showAddServerbox', array('$$$id' => $Mailaccount->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWMAILACCOUNT__SERVERBOXES_ADD}'); ?></a>
	<a href="<?php $this->setUrl('$$$refreshServerboxes', array('$$$id' => $Mailaccount->getInfo('id'))); ?>">
	    <?php $this->set('{SHOWMAILACCOUNT__SERVERBOXES_REFRESH}'); ?></a>
    </p>
</div>
