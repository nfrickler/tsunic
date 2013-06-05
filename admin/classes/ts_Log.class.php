<!-- | CLASS ts_Log -->
<?php
/**
 * Logging for backend
 */
class ts_Log {

    /** Current loglevel (default=3)
     * @var int $level
     */
    protected $level = 3;

    /** Constructor
     * @param int $loglevel
     *	Loglevel
     */
    public function __construct ($loglevel = 3) {
	$this->level = $loglevel;
    }

    /** Write sth. to log
     * @param int $level
     *	Loglevel of message
     * @param string $msg
     *	Log message
     */
    public function doLog ($level, $msg) {
	global $Config;
	if ($level > $this->level) return;

	// create log message
	$msg = date("Y-m-d H:i:s")."|$level|$msg\n";

	// write log
	ts_FileHandler::writeFile($Config->get('dir_data').'/log/backend.log', $msg)
	    or die("ts_Log::doLog: Unable to log message: $msg");
    }
}
?>
