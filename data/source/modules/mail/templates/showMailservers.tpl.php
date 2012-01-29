<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/showMailservers.tpl.php
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
<div id="$$$div__showMailservers">
	<h1><?php $this->set('{SHOWMAILSERVERS__H1}'); ?></h1>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__INFOTEXT}'); ?></p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_INFO}'); ?></p>
	<?php $this->display('$$$showListAccounts', array('mailaccounts' => $this->getVar('mailaccounts'))); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddAccount'); ?>">
			<?php $this->set('{SHOWMAILSERVERS__ACCOUNTS_ADD}'); ?></a>
	</p>

	<h2 style="margin-top:15px;"><?php $this->set('{SHOWMAILSERVERS__SMTPS_H1}'); ?></h2>
	<p class="ts_infotext"><?php $this->set('{SHOWMAILSERVERS__SMTPS_INFO}'); ?></p>
	<?php $this->display('$$$showListSmtps', array('smtps' => $this->getVar('smtps'))); ?>
	<p class="ts_sublinkbox">
		<a href="<?php $this->setUrl('$$$showAddSmtp'); ?>">
			<?php $this->set('{SHOWMAILSERVERS__SMTPS_ADD}'); ?></a>
	</p>
</div>