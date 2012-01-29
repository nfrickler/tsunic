<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/deleteSmtp.func.php
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

function $$$deleteSmtp () {
	global $TSunic;

	// get input
	$id_mail_smtp = $TSunic->Temp->getParameter('id_mail__smtp');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp', $id_mail_smtp);

	// delete smtp-server
	$return = $Smtp->deleteSmtp();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETESMTP__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{DELETESMTP__SUCCESS}', 3);
	$TSunic->redirect('back');

	return true;
}
?>