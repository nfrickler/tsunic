<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			templates/_system_navigation.tpl.php
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

// get input
$mailboxes = $this->getVar('mailboxes');
?>
<div id="$$$_div__navigation">
	<ul>
		<li id="$$$_navigation__showMailBoxes">
			<a href="<?php $this->setUrl('$$$showMailboxes'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILBOXES}'); ?>
			</a>
		</li>
		<?php foreach ($mailboxes as $index => $value) { ?>
		<li id="$$$_navigation__showMailbox_<?php $this->set($value->getInfo('id_mail__box')); ?>" class="$navigation__tsuniccoremodule$sub">
			<a href="<?php $this->setUrl('$$$showMailbox', array('id_mail__box' => $value->getInfo('id_mail__box'))); ?>">
				<?php $this->set($value->getInfo('name')); ?>
			</a>
		</li>
		<?php } ?>
		<li id="$$$_navigation__showSendMail">
			<a href="<?php $this->setUrl('$$$showSendMail'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWSENDMAIL}'); ?>
			</a>
		</li>
		<li id="$$$_navigation__showMailservers">
			<a href="<?php $this->setUrl('$$$showMailservers'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILSERVERS}'); ?>
			</a>
		</li>
		<!--
		<li id="$$$_navigation__showMailSettings">
			<a href="<?php $this->setUrl('$$$showMailsettings'); ?>">
				<?php $this->set('{_NAVIGATION__SHOWMAILSETTINGS}'); ?>
			</a>
		</li>
		-->
	</ul>
</div>

<script type="text/javascript">

	// add events
	document.getElementById('$$$_navigation__showMailBoxes').onclick = function(){location.href='<?php $this->setUrl('$$$showMailboxes', false, false); ?>';};
	<?php foreach($this->getVar('mailboxes') as $index => $value) {
		echo 'document.getElementById("$$$_navigation__showMailbox_'.$value->getInfo('id_mail__box').'").onclick = function(){location.href="'.$this->setUrl('$$$showMailbox', array('id_mail__box' => $value->getInfo('id_mail__box')), false, false).'";};';
	} ?>
	document.getElementById('$$$_navigation__showMailservers').onclick = function(){location.href='<?php $this->setUrl('$$$showMailservers', false, false); ?>';};
	document.getElementById('$$$_navigation__showSendMail').onclick = function(){location.href='<?php $this->setUrl('$$$showSendMail', false, false); ?>';};
/*	document.getElementById('$$$_navigation__showMailSettings').onclick = function(){location.href='<?php $this->setUrl('$$$showMailsettings', false, false); ?>';};
*/
</script>