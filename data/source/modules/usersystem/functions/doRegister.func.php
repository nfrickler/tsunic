<!-- | register new user -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			functions/doRegister.func.php
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

function $$$doRegister () {
	global $TSunic;

	// get input
	$name = $TSunic->Temp->getPost('$$$formRegistration__name');
	$email = $TSunic->Temp->getPost('$$$formRegistration__email');
	$password = $TSunic->Temp->getPost('$$$formRegistration__password');
	$passwordrepeat = $TSunic->Temp->getPost('$$$formRegistration__passwordrepeat');

	// create default account- and profile-object
	$Account = $TSunic->get('$$$Account');
	$Profile = $TSunic->get('$$$Profile');

	// validate input
	if ($password != $passwordrepeat) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDREPEAT}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$Account->isValidEMail($email)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDEMAIL}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$Account->isValidPassword($password)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDPASSWORD}');

		// redirect back to form
		$TSunic->redirect('back');
	}
	if (!$Profile->isValidName($name)) {

		// password wrong repeated!
		$TSunic->Log->add('error', '{DOREGISTER__INVALIDNAME}', 3);

		// redirect back to form
		$TSunic->redirect('back');
	}

	// register user
	$return = $TSunic->CurrentUser->doRegister($email, $password, $name);

	// return
	if ($return) {

		// delete registration-data in Temp
		$TSunic->Temp->reset();

		// set preset for login-form
		$expire = time() + 60 * 60 * 24 * 365;
		setCookie('$$$formLogin__emailname', $name, $expire);

		// success
		$TSunic->Log->add('info', '{DOREGISTER__SUCCESS}', 3);

		// show login
		$TSunic->redirect('$$$showLogin');
		exit;
	}

	// failed
	$TSunic->Log->add('error', '{DOREGISTER__ERROR}', 3);
	$TSunic->redirect('back');
	exit;
}
?>