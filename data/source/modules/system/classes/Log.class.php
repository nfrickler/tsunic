<!-- | CLASS logging and alert messages -->
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

	// save level (default: 3)
	if (!is_numeric($level)) $level = 3;
	if ($level > 9) $level = 9;
	if ($level < 0) $level = 0;
	$this->level = ($level) ? $level : 3;

	// load messages from SESSION
	$this->messages = (isset($_SESSION['$$$Log']))
	    ? $_SESSION['$$$Log'] : array();

	// redirect php's error handling to save message in log
	set_error_handler( array( '$$$Log', 'captureNormal' ) );
	set_exception_handler( array( '$$$Log', 'captureException' ) );
	register_shutdown_function( array( '$$$Log', 'captureShutdown' ) );
    }

    /* handle php errors
     * @param int: error number
     * @param string: error message
     * @param string: path of file
     * @param int: line in file
     */
    public static function captureNormal ($number, $msg, $file, $line) {

	// join error message
	$errmsg = "PHP Error: $number: $msg in $file line $line";

	// log:
	global $TSunic;
	if ($TSunic and $TSunic->Log) {
	    $TSunic->Log->log(3, "PHP error: $errmsg");
	} else {
	    # exit
	    die("PHP error: $errmsg");
	}

	// print message
	echo "<pre>ERROR: A PHP error occurred!</pre>";
    }

    /* handle php errors
     * @param string: exception
     */
    public static function captureException ($exception) {

	// log
	global $TSunic;
	$TSunic->Log->log(3, "PHP Exception: $exception");

	// print message
	echo "<pre>ERROR: A PHP exception occurred!</pre>";
    }

    /* handle php errors
     */
    public static function captureShutdown () {
	$error = error_get_last();
	if ($error) {

	    // error message
	    $error_msg = $error['type'].": ".$error['message']." in " .
		$error['file']." line ".$error['line'];

	    // log
	    global $TSunic;
	    $TSunic->Log->log(3, "PHP shutdown: $error_msg");

	    // print message
	    echo "<pre>ERROR: A PHP shutdown occurred!</pre>";
	} else {
	    return true;
	}
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
	if ($level > $this->level) return true;

	// add message to log
	// only use $$$File to get path
	// DO NOT USE IT FOR WRITING THE LOG (RECURSION!)
	global $TSunic;
	if (!$TSunic) return false;
	$File = $TSunic->get('$$$File', array('#data#log/frontend.log', true));
	$path = $File->getPath();

	// manually write to log file
	$fh = fopen($path, 'a') or die("Could not open log file!");
	fwrite($fh, date('Y-m-d H:i:s')."[$level]: $msg\n");
	fclose($fh);

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
