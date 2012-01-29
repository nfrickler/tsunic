<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/showDeleteAccount.func.php
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

function $$$showDeleteAccount () {
	global $TSunic;

	// get id_mail__account
	$id_mail__account = $TSunic->Temp->getParameter('id_mail__account');

	// get mailaccount-object
	$Account = $TSunic->get('$$$Account', $id_mail__account);

	// activate template
	$data = array('Account' => $Account);
	$TSunic->Tmpl->activate('$$$showDeleteAccount', '$system$content', $data);
	$TSunic->Tmpl->activate('$system$html', false, array('title' => '{SHOWDELETEACCOUNT__TITLE}'));

	return true;
}
?>