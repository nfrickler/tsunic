<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/showMailbox.func.php
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

function $$$showMailbox () {
	global $TSunic;

	// get id_mail__box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');
	if (!is_numeric($id_mail__box)) $id_mail__box = 0;

	// get MailBox-object
	$Mailbox = ($id_mail__box == 0) ? $TSunic->get('$$$Inbox') : $TSunic->get('$$$Box', $id_mail__box);

	// get mailboxes
	$Supermail = $TSunic->get('$$$SuperMail');
	$mailboxes = $Supermail->getMailboxes();
	foreach ($mailboxes as $index => $Value) {
		if ($Value->getInfo('id_mail__box') == $id_mail__box) {
			unset($mailboxes[$index]);
			break;
		}
	}

	// check for new mails
	if (!$TSunic->isJavascript()) $Mailbox->checkMails();

	// activate template
	$data = array('Mailbox' => $Mailbox,
				  'mailboxes' => $mailboxes);
	$TSunic->Tmpl->activate('$$$showMailbox', '$system$content', $data);

	return true;
}
?>