<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showAccount.tpl.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */
?>
﻿<!-- | -->
<?php


// add javascript
$TSunic->Tmpl->addJSfunction('$system$showOptionbox');

// get input
$Mailaccount = $this->getVar('Mailaccount');
?>
<div id="$$$div__showAccount">
	<h1><?php $this->set('{SHOWACCOUNT__H1}', array('name' => $Mailaccount->getInfo('name'))); ?></h1>
	<p class="ts_suplinkbox">
		<a href="<?php $this->setUrl('$$$showEditAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account'))); ?>"><?php $this->set('{SHOWACCOUNT__TOEDITACCOUNT}'); ?></a>
		<a href="<?php $this->setUrl('$$$showDeleteAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account'))); ?>"><?php $this->set('{SHOWACCOUNT__TODELETEACCOUNT}'); ?></a>
	</p>
	<p class="ts_infotext">
		<?php $this->set('{SHOWACCOUNT__INFOTEXT}'); ?>
	</p>
	<table cellspacing="2" cellpadding="0" border="0">
		<?php if ($name = $Mailaccount->getInfo('name') AND !empty($name)) { ?>
	    <tr>
	        <th style="min-width:200px;"><?php echo $this->set('{SHOWACCOUNT__NAME}'); ?></th>
	        <td style="min-width:200px;" id="$$$showAccount__name"><?php $this->set($Mailaccount->getInfo('name')); ?></td>
	    </tr>
	    <?php } ?>
	    <?php if ($description = $Mailaccount->getInfo('description') AND !empty($description)) { ?>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__DESCRIPTION}'); ?></th>
	        <td id="$$$showAccount__description"><?php $this->set($Mailaccount->getInfo('description')); ?></td>
	    </tr>
	    <?php } ?>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__EMAIL}'); ?></th>
	        <td id="$$$showAccount__email"><?php $this->set($Mailaccount->getInfo('email')); ?></td>
	    </tr>
	    <tr>
	        <th><?php echo $this->set('{SHOWACCOUNT__DATEOFCREATION}'); ?></th>
	        <td id="$$$showAccount__dateOfCreation"><?php $this->set($Mailaccount->getInfo('dateOfCreation')); ?></td>
	    </tr>
	</table>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWACCOUNT__SERVERBOXES_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWACCOUNT__SERVERBOXES_INFO}'); ?></p>
	<form action="<?php $this->setUrl('$$$activateServerboxes'); ?>" name="$$$showAccount__serverboxes_form" method="post">
		<input type="hidden" name="$$$showAccount__id_mail__account" value="<?php $this->set($Mailaccount->getInfo('id_mail__account')); ?>" />
		<?php $this->display('$$$showListServerboxes', array('serverboxes' => $Mailaccount->getServerboxes(),
																'selectable' => '$$$showAccount__serverboxes_')); ?>
		<input type="submit" class="ts_submit" value="<?php $this->set('{SHOWACCOUNT__SERVERBOXES_SUBMIT}'); ?>" />
	</form>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddServerbox', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SERVERBOXES_ADD}'); ?></a>
		<a href="<?php $this->setUrl('$$$refreshServerboxes', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SERVERBOXES_REFRESH}'); ?></a>
	</p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWACCOUNT__SMTPS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWACCOUNT__SMTPS_INFO}'); ?></p>
	<?php $this->display('$$$showListSmtps', array('smtps' => $Mailaccount->getSmtps())); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddSmtp', array('fk_mail__account' => $Mailaccount->getInfo('id_mail__account'))); ?>">
			<?php $this->set('{SHOWACCOUNT__SMTPS_ADD}'); ?></a>
	</p>
</div>