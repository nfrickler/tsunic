<!-- | login user -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			functions/doLogin.func.php
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

function $$$doLogin () {
	global $TSunic;

	// set preset for login-form
	$expire = time() + 60 * 60 * 24 * 365;
	setCookie('$$$formLogin__emailname', $TSunic->Temp->getPost('$$$formLogin__emailname'), $expire);

	// do login
	$return = $TSunic->CurrentUser->doLogin($TSunic->Temp->getPost('$$$formLogin__emailname'),
											$TSunic->Temp->getPost('$$$formLogin__password'));

	// check, if login was successfull
	if ($return === true) {

		// success
		$TSunic->Log->add('info', '{DOLOGIN__SUCCESS}', 3);

		// redirect to showMain
		$TSunic->redirect('$system$showMain');
	} else {

		// login failed
		$TSunic->Log->add('error', '{DOLOGIN__FAILED}', 3);

		// return to login-page
		$TSunic->redirect('$$$showIndex');
	}

	exit;
}
?>