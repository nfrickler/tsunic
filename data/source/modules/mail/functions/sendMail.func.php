<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			functions/sendMail.func.php
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

function $$$sendMail () {
	global $TSunic;

	// get input
	$id_mail__smtp = $TSunic->Temp->getPost('$$$showSendMail__id_mail__smtp');
	$addressees = $TSunic->Temp->getPost('$$$showSendMail__addressee');
	$subject = $TSunic->Temp->getPost('$$$showSendMail__subject');
	$content = $TSunic->Temp->getPost('$$$showSendMail__content');
	$addressees = explode(';', $addressees);

	// get smtp-server-object
	if ($id_mail__smtp == 0) {
		$Smtp = $TSunic->get('$$$SenderLocal');
	} else {
		$Smtp = $TSunic->get('$$$Smtp', $id_mail__smtp);
	}

	// validate input
	if (!$Smtp->isValidSubject($subject)
			OR !$Smtp->isValidMessage($content)
		) {
		$TSunic->Log->add('error', '{SENDMAIL__INVALIDINPUT}');
		$TSunic->redirect('back');
	}
	foreach ($addressees as $index => $value) {
		if (!$Smtp->isValidAddressee($value)) {
			// invalid addressee
			$TSunic->Log->add('error', '{SENDMAIL__INVALIDADDRESSEE}');
			$TSunic->redirect('back');
		}
	}

	// send mail
	$return = $Smtp->sendMail($addressees, $subject, $content);

	// check, if error occurred
	if (!$return) {
		$TSunic->Log->add('error', '{SENDMAIL__ERROR} ('.$Smtp->getInfo('error_msg').')');
		$TSunic->redirect('back');
	}

	// success
	$TSunic->Log->add('info', '{SENDMAIL__SUCCESS}');
	$TSunic->redirect('$$$showMailboxes');

	return true;
}
?>