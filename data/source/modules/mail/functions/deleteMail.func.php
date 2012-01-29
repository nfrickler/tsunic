<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/deleteMail.func.php
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

function $$$deleteMail () {
	global $TSunic;

	// get input
	$id_mail__mail = $TSunic->Temp->getParameter('id_mail__mail');

	// get mailbox-object and fk_mail_box
	$Mail = $TSunic->get('$$$Mail', $id_mail__mail);
	$fk_mail__box = $Mail->getInfo('fk_mail__box');

	// edit mailbox
	$return = $Mail->deleteMail();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEMAIL__ERROR}');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETEMAIL__SUCCESS}');
	$TSunic->redirect('$$$showMailbox', array('id_mail__box' => $fk_mail__box));

	return true;
}
?>