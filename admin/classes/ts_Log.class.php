<!-- | Backend Logging Class -->
<?php
class ts_Log {

    /* current loglevel
     * int
     */
    protected $level = 3;

    /* constructor
     * +@param int: loglevel
     */
    public function __construct ($loglevel = 3) {
	$this->level = $loglevel;
    }

    /* write sth. to log
     * @param int: loglevel of message
     * @param string: message
     */
    public function doLog ($level, $msg) {
	global $Config;
	if ($level > $this->level) return;

	// create log message
	$msg = date("Y-m-d H:i:s")."|$level|$msg\n";

	// write log
	ts_FileHandler::writeFile($Config->getRoot(true).'/files/cache/backend.log', $msg, 2)
	    or die("ts_Log::doLog: Unable to log message: $msg");
    }
}
?>
