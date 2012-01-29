<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/addAccount.func.php
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

function $$$addAccount () {
	global $TSunic;

	// get input
	$email = $TSunic->Temp->getPost('$$$formAccount__email');
	$password = $TSunic->Temp->getPost('$$$formAccount__password');
	$name = $TSunic->Temp->getPost('$$$formAccount__name');
	$description = $TSunic->Temp->getPost('$$$formAccount__description');
	$host = $TSunic->Temp->getPost('$$$formAccount__host');
	$port = $TSunic->Temp->getPost('$$$formAccount__port');
	$user = $TSunic->Temp->getPost('$$$formAccount__user');
	$protocol = $TSunic->Temp->getPost('$$$formAccount__protocol');
	$auth = $TSunic->Temp->getPost('$$$formAccount__auth');
	$connsecurity = $TSunic->Temp->getPost('$$$formAccount__connsecurity');

	// get new mailaccount-object
	$Mailaccount = $TSunic->get('$$$Account');

	// validate input
	if (!$Mailaccount->isValidEmail($email)
			OR !$Mailaccount->isValidPassword($password)
			OR !$Mailaccount->isValidName($name)
			OR !$Mailaccount->isValidDescription($description)) {
		// invalid input
		$TSunic->Log->add('error', '{ADDACCOUNT__INVALIDINPUT}', 3);
		$TSunic->redirect('back');
	}

	// create account
	$return = $Mailaccount->createAccount($email, $password, $name, $description);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDACCOUNT__ERROR}', 3);
		$TSunic->redirect('back');
	}

	// try to set connection
	$return = $Mailaccount->setConnection($host, $port, $user, $protocol, $auth, $connsecurity);

	// check for connection-errors
	if (!$return) {
		$TSunic->Log->add('error', '{ADDACCOUNT__CONNERROR}');
		$TSunic->redirect('$$$showEditAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));
	}

	// success
	$TSunic->Log->add('info', '{ADDACCOUNT__SUCCESS}');
	$TSunic->redirect('$$$showAccount', array('id_mail__account' => $Mailaccount->getInfo('id_mail__account')));

	return true;
}
?>