<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/addServerbox.func.php
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

function $$$addServerbox () {
	global $TSunic;

	// get input
	$fk_mail__server = $TSunic->Temp->getPost('id_mail__account');
	$name = $TSunic->Temp->getPost('$$$formServerbox__name');
	$selectMailbox = $TSunic->Temp->getPost('$$$formServerbox__selectMailbox');
	$newMailbox = $TSunic->Temp->getPost('$$$formServerbox__newMailbox');

	// get mailbox-object
	if ($selectMailbox === 0) {
		// inbox selected
		$Mailbox = $TSunic->get('$$$Inbox');

	} elseif ($selectMailbox == 'new') {
		// create new mailbox

		// create mailbox-object
		$Mailbox = $TSunic->get('$$$Box');

		// validate input
		if (!$Mailbox->isValidName($newMailbox)) {
			// invalid input
			$TSunic->Log->add('error', '{ADDSERVERBOX__INVALIDINPUT}', 3);
			$TSunic->redirect('back');
		}

		// create new mailbox
		if (!$Mailbox->createBox($newMailbox)) {
			// error occurred
			$TSunic->Log->add('error', '{ADDSERVERBOX__ERROROCCURRED}', 3);
			$TSunic->redirect('back');
		}

	} elseif (is_numeric($selectMailbox)) {
		// mailbox selected
		$Mailbox = $TSunic->get('$$$Box', $selectMailbox);

		// check, if exist
		if (!$Mailbox->isValid()) {
			// invalid mailbox
			$TSunic->Log->add('error', '{ADDSERVERBOX__ERROROCCURRED}', 3);
			$TSunic->redirect('back');
		}

	} else {
		// invalid mailbox
		$TSunic->Log->add('error', '{ADDSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// get serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox');

	// validate input
	if (!$Serverbox->isValidName($name)
		OR !$Serverbox->isValidFkAccount($fk_mail__account)) {
		// invalid input

		$TSunic->Log->add('error', '{ADDSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// add serverbox
	$return = $Serverbox->createServerbox($fk_mail__account, $name, $Mailbox->getInfo('id_mail__box'), 0);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDSERVERBOX__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{ADDSERVERBOX__SUCCESS}');
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>