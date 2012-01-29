<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/performMailsAction.func.php
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

function $$$performMailsAction () {
	global $TSunic;

	// get input
	$selectedMails = $TSunic->Temp->getParameter('$$$showMailbox__selectedMails');
	$fk_mail__box = $TSunic->Temp->getPost('$$$showMailbox__moveto');

	// is any mail selected?
	if (empty($selectedMails)) {
		// no mails selected
		$TSunic->Log->add('info', '{PERFORMMAILSACTION__SUCCESS}');
		$TSunic->redirect('back');
	}

	// choose action
	if ($TSunic->Temp->getPost('$$$showMailbox__submit_delete')) {
		// delete mails

		// get mail-objects and delete mails
		foreach ($selectedMails as $index => $value) {
			// get object
			$Mail = $TSunic->get('$$$Mail', $value);

			// delete mail
			$Mail->deleteMail();
		}

	} elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_spam')) {
		// set as spam

		// TODO

	} elseif ($TSunic->Temp->getPost('$$$showMailbox__submit_move')
				or $TSunic->Temp->getPost('$$$showMailbox__submittype')) {
		// move mails

		// get mail-objects and delete mails
		foreach ($selectedMails as $index => $value) {
			// get object
			$Mail = $TSunic->get('$$$Mail', $value);

			// move mail
			$Mail->move($fk_mail__box);
		}
	}

	// success
	$TSunic->Log->add('info', '{PERFORMMAILSACTION__SUCCESS}');
	$TSunic->redirect('back');

	return true;
}
?>