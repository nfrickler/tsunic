<!-- | FUNCTION edit account-data -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | usersystem 1.1
 * file:			functions/editAccount.func.php
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

function $$$editAccount () {
	global $TSunic;

	// get input
	$email = $TSunic->Temp->getPost('$$$formAccount__email');
	$password = $TSunic->Temp->getPost('$$$formAccount__password');
	$passwordrepeat = $TSunic->Temp->getPost('$$$formAccount__passwordrepeat');

	// check, if password-repeat correct
	if ($password != $passwordrepeat) {
		// invalid repeat
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDREPEAT}', 3);
        $TSunic->redirect('back');
	}

	// validate input
	if (!empty($email) AND !$TSunic->CurrentUser->Account->isValidEMail($email)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDEMAIL}', 3);
		$TSunic->redirect('back');
	}
	if (!empty($password) AND !$TSunic->CurrentUser->Account->isValidPassword($password)) {
		// invalid email
		$TSunic->Log->add('error', '{EDITACCOUNT__INVALIDPASSWORD}', 3);
		$TSunic->redirect('back');
	}

	// edit account
	$return = $TSunic->CurrentUser->Account->edit($email, $password);

	// check, if edit successful
	if ($return) {
		// success
		// create info-message and redirect
		$TSunic->Log->add('info', '{EDITACCOUNT__SUCCESS}', 3);
		$TSunic->redirect('$$$showAccount');
		return true;
	}

	// add error-message and redirect back
	$TSunic->Log->add('error', '{EDITACCOUNT__ERROR}', 3);
	$TSunic->redirect('back');
	return true;
}
?>