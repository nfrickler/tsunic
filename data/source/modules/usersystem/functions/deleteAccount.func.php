<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			functions/deleteAccount.func.php
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

function $$$deleteAccount () {
	global $TSunic;

	// get password
	$password = $TSunic->Temp->getParameter('$$$showDeleteAccount__password');

	// validate password
	if (!$TSunic->CurrentUser->isPassword($password)) {
		// wrong password
		$TSunic->Log->add('error', '{DELETEACCOUNT__WRONGPASSWORD}');
		$TSunic->redirect('back');
	}

	// delete account and profile
	$return = $TSunic->CurrentUser->Account->delete();

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{DELETEACCOUNT__ERROR}');
		$TSunic->redirect('back');
	}

	// log out
	$TSunic->CurrentUser->doLogout();

	// delete cookies
	$TSunic->run('$system$resetAllCookies', false, true);

	// success
	$TSunic->Log->add('info', '{DELETEACCOUNT__SUCCESS}');

	// delete user
	$TSunic->CurrentUser->deleteUser();

	// redirect to showIndex
	$TSunic->redirect('default');
	return true;
}
?>