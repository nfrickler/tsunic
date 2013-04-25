<!-- | CLASS Log -->
<?php
/** Log messages and alerts
 *
 * Create log messages and print alerts to the user using this class.
 * An object of this class is available at TSunic::Log
 */
class $$$Log {

    /** Alert messages
     * @var array $messages
     */
    protected $messages;

    /** Log level of the current system (change this in your config file)
     *
     * Log messages are tagged with a level from 1 to 9. The smaller the number
     * the more important the message.
     * If the log level of the message is higher than the one specified here, it 
     * will be skipped.
     *
     * Available levels:
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
     *
     * @var int $level
     */
    protected $level;

    /** Constructor
     *
     * @param int $level
     *	Log level
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

    /** Handle PHP errors
     *
     * @param int $number
     *	Error number
     * @param string $msg
     *	Error message
     * @param string $file
     *	Path of file where the error occurred
     * @param int $line
     *	Line in the file where the error occurred
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

    /** Handle PHP errors
     * @param string $exception
     *	Exception
     */
    public static function captureException ($exception) {

	// log
	global $TSunic;
	$TSunic->Log->log(3, "PHP Exception: $exception");

	// print message
	echo "<pre>ERROR: A PHP exception occurred!</pre>";
    }

    /** Handle PHP shutdowns
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

    /** Create some alert message
     *
     * Add one alert message to be shown to the user. You can choose between
     * error and info messages.
     *
     * @param string $type
     *	Type of alert (error, info)
     * @param string $msg
     *	Message
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

    /** Add log message
     *
     * Log some message. This will be skipped, if the log level is higher than
     * the one specified in the config file
     *
     * @param int $level
     *	Log level of message
     * @param string $msg
     *	Log message
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

    /** Get all alert messages
     *
     * @param string $type
     *	Type of messages to fetch
     * @param bool $delete
     *	Delete messages after returning?
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

    /** Delete all alert messages
     *
     * @param string $type
     *	Type of messages to delete
     *
     * @return bool
     */
    public function flush ($type = '') {

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

    /** Store current messages in SESSION
     *
     * @return bool
     */
    protected function _store () {
	$_SESSION['$$$Log'] = $this->messages;
	return true;
    }
}
?>
