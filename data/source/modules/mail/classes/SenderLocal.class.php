<!-- | -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | mail 1.1
 * file:			classes/SenderLocal.class.php
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

include_once '$$$Smtp.class.php';
class $$$SenderLocal extends $$$Smtp {

	/* constructor
	 * +@params int $id_mail_server: id_mail_server
	 *
	 * @return OBJECT
	 */
	public function __construct ($id_mail__smtp = 0) {

		// save id
		$this->id_mail__smtp = 0;

		// load infos
		$this->getInfo();

		return;
	}

	/* get all data of smtp-server
	 * +@param bool/string $name: name of data (true will return all data)
	 *
	 * @return array
	 * 		   (OR @return bool: false - error)
 	 */
	public function getInfo ($name = true) {
		global $TSunic;

		if (empty($this->info)) {

			// set data
			$this->info['host'] = '{CLASS__SENDERLOCAL__HOST}';
			$this->info['port'] = '0';
			$this->info['user'] = '{CLASS__SENDERLOCAL__USER}';
			$this->info['email'] = $TSunic->Config->getConfig('system_email');
			$this->info['emailname'] = $TSunic->CurrentUser->getInfo('name');
			$this->info['host'] = 0;
			$this->info['id_mail__smtp'] = 0;
		}

		// return requested data
		if ($name === true) return $this->info;
		if (isset($this->info[$name])) return $this->info[$name];
		return false;
	}

	/* create new smtp-server
	 * @param string $host: host
	 * @param int $port: port
	 * @param string $user: user
	 * @param string $password: password
	 * @param string $email: email-address
	 * @param string $emailname: email-name	 	 
	 *
	 * @return bool
 	 */
	public function createSmtp ($host, $port, $user, $password, $email, $emailname) {
		return false;
	}

	/* edit smtp-server
	 * @param string $host: host
	 * @param int $port: port
	 * @param string $user: user
	 * @param string $password: password
	 * @param string $email: email-address
	 * @param string $emailname: email-name	 	 
	 *
	 * @return bool
 	 */
	public function editSmtp ($host, $port, $user, $password, $email, $emailname) {
		return false;
	}

	/* delete smtp-server
	 *
	 * @return bool
 	 */
	public function deleteSmtp () {
		return false;
	}

	/* check, if host is valid
	 * @param string $host: host of server-connection
	 *
	 * @return bool
 	 */
	public function isValidHost ($host) {
		return false;
	}

	/* check, if port is valid
	 * @param string $port: port of server-connection
	 *
	 * @return bool
 	 */
	public function isValidPort ($port) {
		return false;
	}

	/* check, if user is valid
	 * @param string $user: user of server-connection
	 *
	 * @return bool
 	 */
	public function isValidUser ($user) {
		return false;
	}

	/* check, if password is valid
	 * @param string $password: password of server-connection
	 *
	 * @return bool
 	 */
	public function isValidPassword ($password) {
		return false;
	}

	/* check, if smtp-server exists
	 *
	 * @return bool
 	 */
	public function isValid () {

		return true;
	}

	/* send mail with php mail()-function
	 * @param array $addressees: array with addressees
	 * @param string $subject: subject of message
	 * @param string $message: the message itself	 	 
	 *
	 * @return bool
 	 */
	public function sendMail ($addressees, $subject, $message) {
		global $TSunic;

		// is system-email activated?
		if (!$TSunic->Config->getConfig('email_enabled')) {
			return false;
		}

		// validate input
		if (!$this->isValidSubject($subject)
				OR !$this->isValidMessage($message)
		) {
			return false;
		}
		foreach ($addressees as $index => $value) {
			if (!$this->isValidAddressee($value)) return false;
		}

		// validate sender
		$sender = $this->getInfo('email');
		if (empty($sender)) return false;

		// get header of mail
		$headers = '';
		$headers.= 'From:'.$this->getInfo('emailname').'<'.$this->getInfo('email').'>';

		// send mails
		$this->info['error_msg'] = '';
		foreach ($addressees as $index => $value) {

			// send mail
			$return = mail($value, $subject, $message, $headers);

			if ($return == false) {
				// mail could not be sent
				$this->info['error_msg'].= 'Mail to '.$value.' could not be sent! ';
			}
		}

		// return
		if (empty($this->info['error_msg'])) return true;
		return false;
	}

}
?>