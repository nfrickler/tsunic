<!-- | CLASS Session -->
<?php
/** Session handling
 *
 * This class manages the SESSION and saves it in databaes
 *
 */
class $$$Session {

    /** Lifetime of session (seconds)
     * @var int $lifetime
     */
    protected $lifetime = 1800;

    /** Is session readonly?
     * @var bool $readonly
     */
    protected $readonly;

    /** Reference to Database object
     *
     * As the session will be stored after the TSunic object has been destroyed, 
     * we need to save a reference to the Database object here separately
     *
     * @var Database $Db
     */
    protected $Db;

    /** Constructor
     * We will enfoce HTTPS by for TSunic by settings the 'secure' attribute
     * in the session parameters to 'true'. To change this, you can set
     * this attribute to 'false', but it is highly recommended to use HTTPS
     * only!
     *
     * @param Database $Db
     *  Reference to Database object
     * @param bool $readonly
     *	Is session readonly?
     */
    public function __construct (&$Db, $readonly = false) {

	// save input in obj-var
	$this->Db = $Db;
	$this->readonly = $readonly;

	// overwrite session handling
	session_set_save_handler(
	    array(&$this, 'open'),
	    array(&$this, 'close'),
	    array(&$this, 'read'),
	    array(&$this, 'write'),
	    array(&$this, 'destroy'),
	    array(&$this, 'gc')
	);

	// Restrict session
	$lifetime = 1200;
	$path = '/';
	$domain = "";
	$secure = true;
	$httponly = true;
	session_set_cookie_params(
	    $lifetime, $path, $domain, $secure, $httponly
	);

	// Set neutral name for session id
	session_name('id');

	// start session
	session_start();
    }

    /** Open session
     *
     * @param string $save_path
     *	Session path from php.ini
     * @param string $session_name
     *	Name of session
     *
     * @return bool
     */
    public function open ($save_path, $session_name) {
	return true;
    }

    /** Read session
     *
     * @param int $id
     *	SESSION_ID
     *
     * @return string
     */
    public function read ($id) {
	$id = base64_encode($id);
	$expired = time() - $this->lifetime;

	// fetch data from database
	$sql = "SELECT data as data
		FROM #__$system$sessions
		WHERE id = '$id'
		    AND NOT timestamp < $expired;";
	$data = $this->Db->doSelect($sql);

	return ($data) ? base64_decode($data[0]['data']) : '';
    }

    /** Write session
     *
     * @param int $id
     *	SESSION_ID
     * @param array $data
     *	Session data
     *
     * @return bool
     */
    public function write ($id, $data) {
	$id = base64_encode($id);
	$data = base64_encode($data);

	// check, if readonly
	if ($this->readonly) return true;

	// get query
	$sql = "INSERT INTO #__$system$sessions
		SET id = '$id',
		    data = '$data',
		    timestamp = '".time()."'
		ON DUPLICATE KEY UPDATE
		    data = '$data',
		    timestamp = '".time()."'
		    ;";
	return $this->Db->doUpdate($sql);
    }

    /** Destroy session
     *
     * @param int $id
     *	SESSION_ID
     *
     * @return bool
     */
    function destroy ($id) {
	$id = base64_encode($id);

	// check, if readonly
	if ($this->readonly) return true;

	// get query
	$sql = "DELETE FROM #__$system$sessions
		WHERE id = '$id';";
	return $this->Db->doDelete($sql);
    }

    /** Garbage collector
     *
     * @param int $life
     *	Lifetime of session
     *
     * @return bool
     */
    function gc ($life) {

	// check, if readonly
	if ($this->readonly) return true;

	// delete all sessions, which have been expired
	$expired = time() - $life;
	$sql = "DELETE FROM #__$system$sessions
		WHERE timestamp < $expired;";
	return $this->Db->doDelete($sql);
    }

    /** Close session
     *
     * @return bool
     */
    public function close () {
	return true;
    }
}
?>
