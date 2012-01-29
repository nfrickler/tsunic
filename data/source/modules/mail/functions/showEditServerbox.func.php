<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/showEditServerbox.func.php
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

function $$$showEditServerbox () {
	global $TSunic;

	// get id_mail__serverbox
	$id_mail__serverbox = $TSunic->Temp->getParameter('id_mail__serverbox');

	// create empty serverbox-object
	$Serverbox = $TSunic->get('$$$Serverbox', $id_mail__serverbox);

	// create SuperMail-object
	$SuperMail = $TSunic->get('$$$SuperMail');

	// activate template
	$data = array('Serverbox' => $Serverbox,
				  'mailboxes' => $mailboxes = $SuperMail->getMailboxes());
	$TSunic->Tmpl->activate('$$$showEditServerbox', '$system$content', $data);

	return true;
}
?>