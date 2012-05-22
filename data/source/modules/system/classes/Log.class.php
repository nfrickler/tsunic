<!-- | class for logging and alert messages -->
<?php
class $$$Log {

	/* array with alert messages
	 * array
	 */
	protected $messages;

	/* logging level of current system
	 * messages with a level above this level will be discarded silently
	 * levels:
	 *    0: very important
	 *    1: critical/fatale
	 *    2: important
	 *    3: serious
	 *    4: uncritical/info
	 *    5: interestring
	 *    6: debugging
	 *    7: normal debugging messages
	 *    8: debugging
	 *    9: debugging
	 * int
	 */
	protected $level;

	/* constructor
	 * +@param int: set level for logging
	 */
	public function __construct ($level = false) {

		// save level
		if (!is_numeric($level)) $level = 5;
		if ($level > 9) $level = 9;
		if ($level < 0) $level = 0;
		$this->level = $level;

		// load messages from SESSION
		$this->messages = (isset($_SESSION['$$$Log']))
			? $_SESSION['$$$Log'] : array();
	}

	/* add alert
	 * @param string: type of alert (error, info)
	 * @param string: message
	 *
	 * @return bool
	 */
	public function alert ($type, $msg) {

		// valid input?
		if (empty($msg) or !in_array($type, array('info','error')))
			return false;

		// prevent doubles
		if (!isset($this->messages[$type])) $this->messages[$type] = array();
		foreach ($this->messages[$type] as $index => $value) {
			if ($value == $msg) return true;
		}

		// save message
		$this->messages[$type][] = $msg;
		$this->_store();

		return true;
	}

	/* add log
	 * @param int: level of log message
	 * @param string: message
	 *
	 * @return bool
	 */
	public function log ($level, $msg) {

		// valid input?
		if (empty($msg) or !is_numeric($level)) return false;

		// add message to log
		$File = $TSunic->get('$$$File', array('#cache#frontend.log', true));

		// add message
		$File->writeAdd(date('Y-m-d H:i:s').'['.$level.']: '.$msg);

		return true;
	}

	/* get alert messages
	 * @param string: type of messages
	 * +@param bool: delete messages afterwards?
	 *
	 * @return array
	 */
	public function get ($type, $delete = false) {
		if (!in_array($type, array('info','error'))
			or !isset($this->messages[$type])
		) return array();
		$return = $this->messages[$type];
		if ($delete) $this->flush($type);
		return $return;
	}

	/* delete all messages
	 *
	 * @return bool
	 */
	public function flush ($type = false) {

		// all or one type?
		if ($type and in_array($type, array('error', 'info'))) {
			if (isset($this->messages[$type]))
				$this->messages[$type] = array();
		} else {
			$this->messages = array();
		}

		$this->_store();
		return true;
	}

	/* store current messages
	 *
	 * @return bool
	 */
	protected function _store () {
		$_SESSION['$$$Log'] = $this->messages;
		return true;
	}
}
?>
