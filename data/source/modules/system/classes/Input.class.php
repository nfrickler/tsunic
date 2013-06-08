<!-- | CLASS Input -->
<?php
/**
 * This class handles all the user input of TSunic.
 * It offers an interface for $_GET, $_POST, $_COOKIE, $_FILES and is a first
 * barrier for XSS attacks.
 */
class $$$Input {

    /** Current history id
     * @var int $current
     */
    private $current;

    /** History of user input
     * @var array $history
     */
    private $history;

    /** Number of requests, which are saved (default: 30)
     * @var int $history_amount
     */
    private $history_num = 30;

    /** Number of requests, which are saved fully (default: 5)
     * @var int $history_complete
     */
    private $history_complete = 5;

    /** Name of session key used for saving history
     * @var string $session_key
     */
    private $session_key = '$$$temp__history';

    /** Constructor
     */
    public function __construct () {

	// onload data from session
	$this->history = (isset($_SESSION[$this->session_key]) and
	    is_array($_SESSION[$this->session_key])
	) ? $_SESSION[$this->session_key] : array();

	// save current history id
	$this->current = (isset($_GET['$$$hid']) and
	    is_numeric($_GET['$$$hid'])
	) ? $this->current : 0;

	// remove old entries in history
	$this->cleanupHistory();

	// update history
	$this->update();
    }

    /** Cleans history from old entries
     *
     * @return void
     */
    private function cleanupHistory () {
	global $TSunic;
	$new_history = array();

	// remove old entries
	ksort($this->history);
	$counter = 0;
	foreach ($this->history as $index => $values) {

	    // remove all history entries of the "future"
	    if ($index > $this->current) continue;

	    if ($counter < $this->history_complete) {
		// keep fully
		$new_history[$index] = $values;
	    } elseif ($counter < $this->history_num) {
		// keep GET parameters only
		$gets = (isset($values['get'])) ? $values['get'] : array();
		$new_history[$index] = array('get' => $gets);
	    }

	    $counter++;
	}

	// update $this->history
	$this->history = $new_history;
    }

    /** Reset history
     *
     * @return void
     */
    public function reset () {
	$this->history = array();
    }

    /** Update temp
     *
     * @return bool
     */
    public function update () {
	$this->history[$this->current] = array(
	    'get' => $_GET,
	    'post'=> $_POST,
	    'cookie'=> $_COOKIE,
	    'files' => $_FILES
	);

	// update session
	$_SESSION[$this->session_key] = $this->history;
    }

    /** Get safe value of $_GET
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function get ($name, $hid = 0) {
	return $this->getSafe($this->getRaw($name, $hid));
    }

    /** Get raw (=insecure!) value of $_GET
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function getRaw ($name, $hid = 0) {
	return $this->_abstractRaw('get', $name, $hid);
    }

    /** Get safe value of $_POST
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function post ($name, $hid = 0) {
	return $this->getSafe($this->postRaw($name, $hid));
    }

    /** Get raw (=insecure!) value of $_POST
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function postRaw ($name, $hid = 0) {
	return $this->_abstractRaw('post', $name, $hid);
    }

    /** Get safe value of $_COOKIE
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function cookie ($name, $hid = 0) {
	return $this->getSafe($this->cookieRaw($name, $hid));
    }

    /** Get raw (=insecure!) value of $_COOKIE
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function cookieRaw ($name, $hid = 0) {
	return $this->_abstractRaw('cookie', $name, $hid);
    }

    /** Get safe value of $_FILES
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function files ($name, $hid = 0) {
	return $this->getSafe($this->filesRaw($name, $hid));
    }

    /** Get raw (=insecure!) value of $_COOKIE
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function filesRaw ($name, $hid = 0) {
	return $this->_abstractRaw('files', $name, $hid);
    }

    /** Get raw (=insecure!) value of specified type
     * @param string $type
     *	Type of value to return (get, post, files, cookie)
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    private function _abstractRaw ($type, $name, $hid = 0) {
	$hid = $this->getHid($hid);
	if (!isset($this->history[$hid]) or
	    !isset($this->history[$hid][$type])
	) return NULL;
	if ($name === true) return $this->history[$hid][$type];
	return (isset($this->history[$hid][$type][$name]))
	    ? $this->history[$hid][$type][$name] : NULL;
    }

    /** Make parameter a little bit safer
     * @param array|string $input
     *	Input string or array
     *
     * @return array|string
     */
    public function getSafe ($input) {
	if (is_array($input)) {
	    foreach ($input as $index => $value) {
		$input[$index] = $this->getSafe($value);
	    }
	    return $input;
	}
	return preg_replace('#[^-a-zA-Z0-9_+?äöüÄÖÜ?\.,:!\?]@#', '_', $input);
    }

    /** Get safe parameter from get or post
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function param ($name, $hid = 0) {
	return $this->getSafe($this->paramRaw($name, $hid));
    }

    /** Get raw (=insecure!) parameter from get or post
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function paramRaw ($name, $hid = 0) {
	$get = $this->getRaw($name, $hid);
	return ($get === NULL) ? $this->postRaw($name, $hid) : $get;
    }

    /** Get safe unsigned int parameter from get or post
     * @param string $name
     *	Name of get parameter to return
     * @param int $hid
     *	History id of data to return
     *
     * @return mix
     */
    public function uint ($name, $hid = 0) {
	$int = intval($this->param($name, $hid));
	return ($int > 0) ? $int : 0;
    }

    /** Get raw (=insecure!) post parameters with a certain prefix
     * @param string $prefix
     *	Prefix of post-name
     * @param int $hid
     *	History id of data to return
     *
     * @return bool
     */
    public function postByPrefix ($prefix, $hid = 0) {

	// get all post-parameters
	$all_posts = $this->postRaw(true, $time);

	// get requested elements
	$output = array();
	foreach ($all_posts as $index => $value) {
	    if (substr($index, 0, strlen($prefix)) == $prefix) {
		// add to output
		$output[substr($index, (strlen($prefix)+1))] = $value;
	    }
	}

	return $output;
    }

    /** Get history id
     * @param int $offset
     *	Positive offsets will return the offset itself, 0 will return the 
     *	current hid (default) and a negative offset will return a hid from the 
     *	past (current + (-offset))
     *
     * @return int
     */
    public function getHid ($offset = 0) {
	if ($offset == 0) return $this->current;
	if ($offset < 0) return $this->current + $offset;
	return $hid;
    }
}
?>
