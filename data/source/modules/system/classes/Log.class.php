<!-- | class for logging, error- and info-messages -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Log.class.php
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

class $$$Log {

	/* array with all error-messages
	 * array
	 */
	private $error_msg = array();

	/* array with all info-messages
	 * array
	 */
	private $info_msg = array();

	/* array with all warning-messages
	 * array
	 */
	private $warning_msg = array();

	/* array with all log-messages
	 * array
	 */
	private $log_msg = array();

	/* logging level (0 to 9: 0 - show all messages; 9 - show no messages)
	 * int
	 */
	private $level = 0;

	/* index of SESSION-var to save messages
	 * string
	 */
	private $session_key = '$$$Log';

	/* constructor
	 * @param
	 *
	 * @return OBJECT
	 */
	public function __construct ($level = false) {

		// validate level
		if (!is_numeric($level)) $level = 5;
		if ($level > 9) $level = 9;
		if ($level < 0) $level = 0;

		// save level
		$this->level = $level;

		// load messages from SESSION
		if (isset($_SESSION[$this->session_key])) {
			if (isset($_SESSION[$this->session_key]['error_msg'])
				AND is_array($_SESSION[$this->session_key]['error_msg']))
				$this->error_msg = $_SESSION[$this->session_key]['error_msg'];
			if (isset($_SESSION[$this->session_key]['info_msg'])
				AND is_array($_SESSION[$this->session_key]['info_msg']))
				$this->info_msg = $_SESSION[$this->session_key]['info_msg'];
			if (isset($_SESSION[$this->session_key]['warning_msg'])
				AND is_array($_SESSION[$this->session_key]['warning_msg']))
				$this->warning_msg = $_SESSION[$this->session_key]['warning_msg'];
		}

		return;
	}

	/* add new log
	 * @param string $type: type of message (error, info, warning)
	 * @param string $message: message
	 * +@param $level: level of message (0-10: 0 - no matter; 9 - very important; 10 - log-worthy)	 
	 * +@param bool/string $redirect: false - no redirect; event to redirect to
	 *
	 * @return bool/REDIRECT
	 */
	public function add ($type, $message, $level = 3, $redirect = false) {
		global $TSunic;

		// validate
		if (empty($message)) return false;
		if (!in_array($type, array('error', 'info', 'warning'))) return false;

		// save log-messages
		if ($level < 3) {
			if (!isset($this->log_msg[$type])) $this->log_msg[$type] = array();
			$this->_add($this->log_msg[$type], $type, $message);
		}

		// skip, if user-defined level is too low
		if ($this->level < $level) return true;

		// add error
		switch ($type) {
			case 'error':
				$this->_add($this->error_msg, $type, $message);
				break;
			case 'info':
				$this->_add($this->info_msg, $type, $message);
				break;
			case 'warning':
				$this->_add($this->warning_msg, $type, $message);
				break;
		}

		// save new data
		$this->_store();

		// redirect?
		if ($redirect) $TSunic->redirect($redirect);

		return true;
	}

	/* add new message to obj-var
	 * @param string $type: type of message (error, info, warning)
	 * @param string $message: message
	 *
	 * @return bool/REDIRECT
	 */
	private function _add (&$array, $type, $message) {

		// prevent doubles
		$isset = false;
		foreach ($array as $index => $value)
			if ($value == $message) $isset = true;

		// save
		if (!$isset) $array[] = $message;

		return true;
	}

	/* get log-messages
	 * @param string $type: type of messages to return
	 * +@param bool $delete: delete messages?
	 * 
	 * @return array
	 */
	public function get ($type, $delete = false) {
		$return = array();

		// get by type
		switch ($type) {
			case 'error':
				$return = $this->error_msg;
				break;
			case 'info':
				$return = $this->info_msg;
				break;
			case 'warning':
				$return = $this->warning_msg;
				break;
				
		}

		// delete messages?
		if ($delete) $this->delete($type);

		return $return;
	}

	/* delete messages
	 * @param string $type: type of messages; 'all' empties $this->messages
	 *
	 * @return bool
	 */
	public function delete ($type) {

		// get by type
		switch ($type) {
			case 'error':
				$this->error_msg = array();
				break;
			case 'info':
				$this->info_msg = array();
				break;
			case 'warning':
				$this->warning_msg = array();
				break;
		}

		// save new data
		$this->_store();

		return true;
	}

	/* store current messages
	 *
	 * @return bool
	 */
	private function _store () {
		global $TSunic;

		// save messages in SESSION
		$_SESSION[$this->session_key] = array('error_msg' => $this->error_msg,
											  'info_msg' => $this->info_msg,
											  'warning_msg' => $this->warning_msg);

		// save logs in log-file
		if (!empty($this->log_msg)) {

			// get file-object
			$File = $TSunic->get('$$$File', array('#cache#$$$log.txt', true));

			// add logs
			foreach ($this->log_msg as $index => $value) {
				if (empty($value)) continue;
				$File->writeAdd(' '.$index.': '.$value[0]);
			}

			// clear log-messages
			$this->log_msg = array();
		}

		return true;
	}
}
?>