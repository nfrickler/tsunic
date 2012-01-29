<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/addSmtp.func.php
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

function $$$addSmtp () {
	global $TSunic;

	// get input
	$fk_mail__account = $TSunic->Temp->getParameter('$$$formSmtp__mailaccount');
	$email = $TSunic->Temp->getParameter('$$$formSmtp__email');
	$password = $TSunic->Temp->getParameter('$$$formSmtp__password');
	$emailname = $TSunic->Temp->getParameter('$$$formSmtp__emailname');
	$description = $TSunic->Temp->getParameter('$$$formSmtp__description');
	$host = $TSunic->Temp->getParameter('$$$formSmtp__host');
	$port = $TSunic->Temp->getParameter('$$$formSmtp__port');
	$auth = $TSunic->Temp->getParameter('$$$formSmtp__auth');
	$connsecurity = $TSunic->Temp->getParameter('$$$formSmtp__connsecurity');
	$user = $TSunic->Temp->getParameter('$$$formSmtp__user');

	// get smtp-object
	$Smtp = $TSunic->get('$$$Smtp');

	// validate input
	if (!$Smtp->isValidEMail($email)
			OR !$Smtp->isValidPassword($password)
			OR !$Smtp->isValidDescription($description)
			OR !$Smtp->isValidEMailname($emailname)
	) {
		// invalid input
		$TSunic->Log->add('error', '{ADDSMTP__INVALIDINPUT}');
		$TSunic->redirect('back');
	}

	// create new smtp
	$return = $Smtp->createSmtp($email, $password, $description, $emailname);

	// check, if error occured
	if (!$return) {
		$TSunic->Log->add('error', '{ADDSMTP__ERROR}');
		$TSunic->redirect('back');
	}

	// add mailaccount
	if (!empty($fk_mail__account)) {
		$Mailaccount = $TSunic->get('$$$Account', $fk_mail__account);
		if (!$Mailaccount OR !$Smtp->setMailaccount($Mailaccount)) {
			$TSunic->Log->add('error', '{ADDSMTP__ERROR}');
			$TSunic->redirect('back');
		}
	}

	// try to set connection
	$return = $Smtp->setConnection($host, $port, $user, $auth, $connsecurity);

	// check for connection-errors
	if (!$return) {
		$TSunic->Log->add('error', '{ADDSMTP__CONNERROR}', 3);
		$TSunic->redirect('$$$showEditSmtp', array('id_mail__smtp' => $Smtp->getInfo('id_mail__smtp')));
	}

	// success
	$TSunic->Log->add('info', '{ADDSMTP__SUCCESS}', 3);
	$TSunic->redirect('$$$showMailservers');

	return true;
}
?>