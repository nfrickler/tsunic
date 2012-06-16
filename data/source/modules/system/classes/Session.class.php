<!-- | CLASS Session -->
<?php
class $$$Session {

    /* life time of session (seconds)
     * int
     */
    protected $lifetime = 1800;

    /* readonly session
     * bool
     */
    protected $readonly;

    /* database-object (has to be referenced here, because
     * session will be closed after global $TSunic object
     * has beeen destroyed!)
     * object
     */
    protected $Db;

    /* constructor
     * @param object: database-object
     * +@param bool: is session readonly?
     */
    public function __construct (&$Db, $readonly = false) {

	// save input in obj-var
	$this->Db = $Db;
	$this->readonly = $readonly;

	// set lifetime
	ini_set('session.gc_maxlifetime', $this->lifetime);

	// set probability of garbage collection (1%)
	ini_set('session.gc_probability', 1);
	ini_set('session.gc_divisor', 100);

	// overwrite session handling
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

    /* open
     * @param string: session path from php.ini
     * @param string: name of session
     *
     * @return OBJECT
     */
    public function open ($save_path, $session_name) {
	return true;
    }

    /* read
     * @param int: SESSION_ID
     *
     * @return string
     */
    public function read ($id) {
	$id = base64_encode($id);
	$expired = time() - $this->lifetime;

	// fetch data from database
	$sql = "SELECT data as data
		FROM #__sessions
		WHERE id = '$id'
		    AND NOT timestamp < $expired;";
	$data = $this->Db->doSelect($sql);

	return ($data) ? base64_decode($data[0]['data']) : '';
    }

    /* write
     * @param int: SESSION_ID
     * @param array: session-data
     *
     * @return bool: true
     */
    public function write ($id, $data) {
	$id = base64_encode($id);
	$data = base64_encode($data);

	// check, if readonly
	if ($this->readonly) return true;

	// get query
	$sql = "INSERT INTO #__sessions
		SET id = '$id',
		    data = '$data',
		    timestamp = '".time()."'
		ON DUPLICATE KEY UPDATE
		    data = '$data',
		    timestamp = '".time()."'
		    ;";
	return $this->Db->doUpdate($sql);
    }

    /* destroy
     * @param int: SESSION_ID
     *
     * @return bool
     */
    function destroy ($id) {
	$id = base64_encode($id);

	// check, if readonly
	if ($this->readonly) return true;

	// get query
	$sql = "DELETE FROM #__sessions
		WHERE id = '$id';";
	return $this->Db->doDelete($sql);
    }

    /* garbage collection
     * @param int: lifetime of session
     *
     * @return bool
     */
    function gc ($life) {

	// check, if readonly
	if ($this->readonly) return true;

	// delete all sessions, which have been expired
	$expired = time() - $life;
	$sql = "DELETE FROM #__sessions
		WHERE timestamp < $expired;";
	return $this->Db->doDelete($sql);
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
