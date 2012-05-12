<!-- | TEMPLATE show list of users -->
<div id="$$$div__showUserlist">
	<h1><?php echo $this->set('{SHOWUSERLIST__H1}'); ?></h1>
	<p class="ts_infotext">
		<?php $this->set('{SHOWUSERLIST__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
		<tr>
			<th><?php echo $this->set('{SHOWUSERLIST__NAME}'); ?></th>
			<?php if ($TSunic->Usr->access('$$$seeAllData')) { ?>
			<th><?php echo $this->set('{SHOWUSERLIST__EMAIL}'); ?></th>
			<th><?php echo $this->set('{SHOWUSERLIST__DATEOFREGISTRATION}'); ?></th>
			<th><?php echo $this->set('{SHOWUSERLIST__DATEOFLASTLOGIN}'); ?></th>
			<?php if ($TSunic->Usr->access('deleteAllUsers')) { ?>
			<th><?php echo $this->set('{SHOWUSERLIST__ACTION}'); ?></th>
			<?php } ?>
			<?php } ?>
		</tr>
		<?php foreach ($this->getVar('users') as $index => $User) { ?>
		<tr>
			<td><?php $this->set($User->getInfo('name')); ?></td>
			<?php if ($TSunic->Usr->access('$$$seeAllData')) { ?>
			<td><?php $this->set($User->getInfo('email')); ?></td>
			<td><?php $this->set($User->getInfo('dateOfRegistration')); ?></td>
			<td><?php $this->set($User->getInfo('dateOfLastLogin')); ?></td>
			<?php if ($TSunic->Usr->access('deleteAllUsers')) { ?>
			<td>
				<a href="<?php $this->setUrl(
					'$$$showDeleteUser',
					array('$$$id' => $User->getInfo('id'))
				); ?>"> <?php $this->set('{SHOWUSERLIST__DELETEUSER}'); ?></a>
			</td>
			<?php } ?>
			<?php } ?>
		</tr>
		<?php } ?>
	</table>
</div>
