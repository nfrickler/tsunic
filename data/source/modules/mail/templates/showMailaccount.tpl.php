<!-- | Template: show mail account -->
<?php
// add javascript
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="$$$div__showMailaccount">
	<h1><?php $this->set('{SHOWACCOUNT__H1}'); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showEditMailaccount', array('$$$id' => $Mailaccount->getInfo('id'))); ?>"><?php $this->set('{SHOWACCOUNT__TOEDITACCOUNT}'); ?></a>
		<a href="<?php $this->setUrl('$$$showDeleteMailaccount', array('$$$id' => $Mailaccount->getInfo('id'))); ?>"><?php $this->set('{SHOWACCOUNT__TODELETEACCOUNT}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWACCOUNT__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
		<?php if ($name = $Mailaccount->getInfo('name') AND !empty($name)) { ?>
		<tr>
			<th style="min-width:200px;"><?php echo $this->set('{SHOWACCOUNT__NAME}'); ?></th>
			<td style="min-width:200px;" id="$$$showMailaccount__name"><?php $this->set($Mailaccount->getInfo('name')); ?></td>
		</tr>
		<?php } ?>
		<?php if ($description = $Mailaccount->getInfo('description') AND !empty($description)) { ?>
		<tr>
			<th><?php echo $this->set('{SHOWACCOUNT__DESCRIPTION}'); ?></th>
			<td id="$$$showMailaccount__description"><?php $this->set($Mailaccount->getInfo('description')); ?></td>
		</tr>
		<?php } ?>
		<tr>
			<th><?php echo $this->set('{SHOWACCOUNT__EMAIL}'); ?></th>
			<td id="$$$showMailaccount__email"><?php $this->set($Mailaccount->getInfo('email')); ?></td>
		</tr>
		<tr>
			<th><?php echo $this->set('{SHOWACCOUNT__DATEOFCREATION}'); ?></th>
			<td id="$$$showMailaccount__dateOfCreation"><?php $this->set($Mailaccount->getInfo('dateOfCreation')); ?></td>
		</tr>
	</table>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWACCOUNT__SERVERBOXES_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWACCOUNT__SERVERBOXES_INFO}'); ?></p>
	<form action="<?php $this->setUrl('$$$activateServerboxes'); ?>" name="$$$showMailaccount__serverboxes_form" method="post">
		<input type="hidden" name="$$$showMailaccount__id" value="<?php $this->set($Mailaccount->getInfo('id')); ?>" />
		<?php $this->display('$$$showListServerboxes', array(
			'serverboxes' => $Mailaccount->getServerboxes(),
			'selectable' => '$$$showMailaccount__serverboxes_'
		)); ?>
		<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCOUNT__SERVERBOXES_SUBMIT}'); ?>" />
	</form>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddServerbox', array('$$$id' => $Mailaccount->getInfo('id'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SERVERBOXES_ADD}'); ?></a>
		<a href="<?php $this->setUrl('$$$refreshServerboxes', array('$$$id' => $Mailaccount->getInfo('id'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SERVERBOXES_REFRESH}'); ?></a>
	</p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWACCOUNT__SMTPS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWACCOUNT__SMTPS_INFO}'); ?></p>
	<?php $this->display('$$$showListSmtps', array('smtps' => $Mailaccount->getSmtps())); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddSmtp', array('fk_mailaccount' => $Mailaccount->getInfo('id'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SMTPS_ADD}'); ?></a>
	</p>
</div>
