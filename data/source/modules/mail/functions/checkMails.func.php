<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/checkMails.func.php
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

function $$$checkMails () {
	global $TSunic;

	// get id_mail__box
	$id_mail__box = $TSunic->Temp->getParameter('id_mail__box');

	if (!empty($id_mail__box)) {
		// check only this mailserver for new mails
		// get mailbox-object
		$Mailbox = $TSunic->get('$$$Box', $id_mail__box);

		// check for new mails
		$Mailbox->checkMails();
	} else {
		// check all mailboxes for new mails
		// get SuperEMail-object
		$SuperMail = $TSunic->get('$$$SuperMail');

		// check for new mails
		$SuperMail->checkMails();
	}

	return true;
}
?>