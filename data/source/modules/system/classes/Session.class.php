<!-- | class for session-management -->
<?php
class $$$Session {

	/* life time of session (milliseconds)
	 * int
	 */
	private $life_time;

	/* minimal life time of session (seconds)
	 * int
	 */
	private $min_life_time = 1800;

	/* readonly session
	 * bool
	 */
	private $readonly;

	/* database-object (has to be referenced here, because
	 * session will be closed after global $TSunic object
	 * has beeen destroyed!)
	 * object
	 */
	private $Db;

	/* constructor
	 * @param object: database-object
	 * +@param bool: is session readonly?
	 */
	public function __construct (&$Db, $readonly = false) {

		// get the maxlifetime setting from PHP (seconds)
		$this->life_time = get_cfg_var("session.gc_maxlifetime");
		if ($this->life_time < $this->min_life_time) $this->life_time = $this->min_life_time;

		// save input in obj-var
		$this->Db = $Db;
		$this->readonly = $readonly;

		// overwrite session-handling
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);

		// start session
		session_start();

		return;
	}

	/* constructor
	 * @param object: database-object
	 *
	 * @return OBJECT
	 */
	public function open ($save_path, $session_name) {
		global $sess_save_path;

		$sess_save_path = $save_path;
		return true;
	}

	/* read
	 * @param int: SESSION_ID
	 *
	 * @return OBJECT
	 */
	public function read ($id) {

		// fetch data from database
		$time = time();
		$sql_0 = "SELECT sessions.data as data
				FROM #__sessions as sessions
				WHERE id__sid = '".mysql_real_escape_string($id)."'
					AND expires > ".$time.";";
		$data_0 = $this->Db->doSelect($sql_0);

		if (count($data_0) > 0) {
			// return session-data
			return $data_0[0]['data'];
		} else {
			// empty session
			return '';
		}
	}

	/* write
	 * @param int: SESSION_ID
	 * @param array: session-data
	 *
	 * @return bool: true - success
	 */
	public function write ($id, $data) {

		// check, if readonly
		if ($this->readonly) return true;

		// get expire-time (milliseconds)
		$expires = time() + $this->life_time;

		// get query
		$sql_0 = "INSERT INTO #__sessions (id__sid, data, expires)
				VALUES ('".mysql_real_escape_string($id)."',
						'".mysql_real_escape_string($data)."',
						'".$expires."')
				ON DUPLICATE KEY UPDATE data = '".mysql_real_escape_string($data)."',
					expires = '".$expires."';";
		$return_0 = $this->Db->doUpdate($sql_0);

		return true;
	}

	/* destroy
	 * @param int: SESSION_ID
	 *
	 * @return bool
	 */
	function destroy ($id) {

		// check, if readonly
		if ($this->readonly) return true;

		// get query
		$newid = mysql_real_escape_string($id);
		$sql_0 = "DELETE FROM #__sessions
						 WHERE id__sid = '".mysql_real_escape_string($id)."';";
		$result_0 = $this->Db->doDelete($sql_0);

		return true;
	}

	/* garbage collection
	 *
	 * @return bool
	 */
	function gc() {

		// check, if readonly
		if ($this->readonly) return true;

		// delete all sessions, which have expired
		$sql_0 = "DELETE FROM #__sessions
				WHERE expires < ".time().";";
		$result_0 = $this->Db->doDelete($sql_0);

		return true;
	}

	/* close
	 *
	 * @return bool
	 */
	public function close () {
		return true;
	}
}
?>
