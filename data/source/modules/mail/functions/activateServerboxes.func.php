<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/activateServerboxes.func.php
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

function $$$activateServerboxes () {
	global $TSunic;

	// get input
	$id_mail__account = $TSunic->Temp->getParameter('$$$showAccount__id_mail__account');
	$activated_serverboxes = $TSunic->Temp->getByPreffix('$$$showAccount__serverboxes_');

	// get mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account', $id_mail__account);

	// get all serverboxes
	$all_serverboxes = $Mailaccount->getServerboxes();

	// check all serverboxes
	foreach ($all_serverboxes as $index => $value) {

		// is active?
		if ($value->getInfo('isActive')) {
			// is active

			// is not selected?
			if (!isset($activated_serverboxes[$value->getInfo('id_mail__serverbox')])) {
				// deactivate
				$value->activate(false);
			}

		} else {
			// is inactive

			// is selected?
			if (isset($activated_serverboxes[$value->getInfo('id_mail__serverbox')])) {
				// activate
				$value->activate(true);
			}
		}
	}

	// success
	$TSunic->Log->add('info', '{ACTIVATESERVERBOXES__SUCCESS}', 3);
	$TSunic->redirect('back');

	return true;
}
?>