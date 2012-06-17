<!-- | class to handle temporare data -->
<?php
class $$$Temp {

    /* history of user
     * array (module => $module, event => $event)
     */
    private $history;

    /* write- and readable cache
     * array
     */
    private $cache;

    /* number of requests, which are saved completely (default: 5)
     * int
     */
    private $history_complete = 5;

    /* number of requests, which are saved (default: 30)
     * int
     */
    private $history_amount = 5;

    /* session-key
     * string
     */
    private $session_key = '$$$temp__history';

    /* constructor
     */
    public function __construct () {
	global $TSunic;

	// onload data from session
	$history = (isset($_SESSION[$this->session_key])) ? $_SESSION[$this->session_key] : array();

	// refresh history
	$this->refreshHistory($history);

	// update history
	$this->update();

	return;
    }

    /* optimizes, updates, stores history
     * +@param array/bool: history to clean (false will refresh $this->history)
     *
     * @return OBJECT
     */
    protected function refreshHistory ($history = false) {
	global $TSunic;

	// check input
	if ($history === false) $history = $this->history;
	if (!is_array($history)) $history = array();

	// clear history-data
	$number_to_clear = count($history) - $this->history_complete;
	foreach ($history as $index => $values) {
	    if ($index > $number_to_clear) continue;
	    if ($index < ($number_to_clear - 2)) break;

	    // skip old entries (keep only get-parameters)
	    if (isset($values['ajax'])) {
		$history[$index]['ajax'] = array('get' => $values['ajax']['get']);
	    } elseif (isset($values['skipped'])) {
		$history[$index] = array('get' => $values['skipped']['get']);
	    } else {
		$history[$index] = array('get' => $values['get']);
	    }
	}

	// remove old entries
	$this->history = array_slice($history, ((-1) * $this->history_amount), null, true);

	// store updated history in SESSION but skip, if not isIndex OR isAjax
	if ($TSunic->isIndex()) {
	    $_SESSION[$this->session_key] = $this->history;
	}

	return $this->history;
    }

    /* reset temp
     *
     * @return bool
     */
    public function reset () {

	// store emtpy history-data
	$this->refreshHistory(array());
	return true;
    }

    /* update temp
     *
     * @return bool
     */
    public function update () {
	global $TSunic;

	// skip, if not loaded by index-file
	if (!$TSunic->isIndex() AND !$TSunic->isAjax() AND !$TSunic->isTemplate()) return true;

	// get $_GET and $_POST
	if (!is_array($_GET)) $_GET = array();
	if (!is_array($_POST)) $_POST = array();

	/* check, if user used backlink (either browser's OR system's) */ 
	$toSkip = 0;

	// check system's
	if (isset($_GET['back']) AND !empty($_GET['back'])) {
	    $toSkip = $_GET['back'];
	}

	// check browsers's
	else {

	    // get last id and real last id
	    $last_id = $this->getCurrentHistoryId();
	    $real_last_id = (isset($_GET['hid']) AND !empty($_GET['hid'])) ? $_GET['hid'] : -1;
	    unset($_GET['hid']);

	    // compare
	    if ($real_last_id > 0 AND $last_id > $real_last_id) {
		// backlink has been used -> mark skipped entries
		$toSkip = $real_last_id - $last_id;
	    }
	}

	// skip entries in history
	if (is_numeric($toSkip) AND $toSkip > 0) {

	    // return, if already skipped
	    if (isset($_GET['noSkip']) AND !empty($_GET['noSkip'])) return true;

	    // mark back-skipped pages as skipped
	    $current_key = $this->_getHistoryKey();
	    for ($i = $current_key; $i >= ($current_key - $this->history_amount); $i--) {

		// end, if all skipped pages are handled
		if ($toSkip <= 0) break;

		// skip ajax-entries and already skipped entries
		if (!isset($this->history[$i])
		    OR isset($this->history[$i]['ajax'])
		    OR isset($this->history[$i]['skipped'])) continue;

		// set as skipped
		$this->history[$i] = array('skipped' => $this->history[$i]);

		// decrease back-value
		$toSkip--;
	    }

	    // refresh history
	    $this->refreshHistory();
	    $_GET['noSkip'] = 'true';
	    if (isset($_GET['back'])) return true;
	}

	// check, if new module
//	$new_get = $this->skipCommandParameters($_GET);
//	$old_get = $this->skipCommandParameters($this->getGet(true, 0));
//	if ($new_get == $old_get) return true;

	// add data
	if ($TSunic->isAjax()) {
	    // add ajax-data
	    // update history
	    $new_array = array(
		'get' => $_GET,
		'post' => $_POST
	    );
	    $this->history[] = array('ajax' => $new_array);
	} else {
	    // add data
	    // update history
	    $this->history[] = array(
		'get' => $this->_getSaferArray($_GET),
		'post' => $_POST
	    );
	}

	// store data
	$this->refreshHistory();
	return true;
    }

    /* try to prevent code-injections
     * @param array: array to parse
     *
     * @return string/bool
     */
    protected function _getSaferArray ($array) {

	// process each
	foreach ($array as $i => $v) {

	    // destroy forbidden keys
	    if (preg_match('#[\'"\/\\\<\>]#', $i)) {
		unset($array[$i]);
		continue;
	    }

	    // destroy forbidden characters
	    $array[$i] = str_replace('"', '', $v);
	    $array[$i] = str_replace("'", '', $v);
	    $array[$i] = str_replace('/', '', $v);
	    $array[$i] = str_replace('\\', '', $v);
	    $array[$i] = str_replace('<', '', $v);
	    $array[$i] = str_replace('>', '', $v);
	}

	return $array;
    }

    /* store data in cache
     * @param string: unique name of information
     * @param string: value
     *
     * @return bool
     */
    public function setCache ($name, $value) {
	// save in cache
	$this->cache[$name] = $value;
	return true;
    }

    /* get data from cache
     * @param string: unique name of information
     *
     * @return bool
     */
    public function getCache ($name) {
	// get and return
	if (isset($this->cache[$name])) return $this->cache[$name];
	return false;
    }

    /* skip command parameters
     * @param array: get-parameters
     *
     * @return bool
     */
    public function skipCommandParameters ($get) {

	// validate input
	if (!is_array($get)) $get = array();

	// skip commands
	if (isset($get['back'])) unset($get['back']);
	if (isset($get['loop'])) unset($get['loop']);
	if (isset($get['noSkip'])) unset($get['noSkip']);
	if (isset($get['hid'])) unset($get['hid']);

	return $get;
    }

    # ########################## get ##################################### #

    /* get current module
     * +@param int: module in history (0 = current; 1 = last; ...)
     *
     * @return string/bool
     */
    public function getModule ($time = 0) {

	// try to get GET-parameter "event"
	$event = $this->getGet('event', $time);

	// extract module
	$cache = explode('__', $event);

	return $cache[0];
    }

    /* get current event
     * +@param int: event in history (0 = current; 1 = last; ...)
     *
     * @return string/bool
     */
    public function getEvent ($time = 0) {

	// try to get GET-parameter "event"
	$get = $this->getGet('event', $time);

	return $get;
    }

    /* get post-data
     * @param string/bool: name of parameter (true will return all)
     * +@param int: module in history (0 = current; 1 = last; ...)
     *
     * @return mix
     */
    public function getPost ($name, $time = 0) {
	global $TSunic;

	// get requested post-array
	$post = array();
	$counter = 0;

	// get key
	$key = $this->_getHistoryKey($time);

	// get requested post-array
	if ($TSunic->isAjax()) {
	    // is ajax
	    // get data
	    if (isset($this->history[$key]['ajax'])
		    AND isset($this->history[$key]['ajax']['post'])) {
		// load data
		$post = $this->history[$key]['ajax']['post'];
	    }
	} else {
	    // no ajax
	    // get data
	    if (isset($this->history[$key])
		    AND isset($this->history[$key]['post'])) {
		// load data
		$post = $this->history[$key]['post'];
	    }
	}

	// return all if requested
	if ($name === true) return $post;

	// check, if requested parameter exist
	if (!isset($post[$name])) return NULL;

	// return requested parameter
	return $post[$name];
    }

    /* get GET-parameters
     * @param string/bool: name of parameter (true will return all, false will return all without event and module)
     * +@param int: module in history (0 = current; 1 = last; ...)
     *
     * @return mix
     */
    public function getGet ($name, $time = 0) {
	global $TSunic;

	// get requested post-array
	$get = array();
	$counter = 0;

	// get key
	$key = $this->_getHistoryKey($time);

	// get requested post-array
	if ($TSunic->isAjax()) {
	    // is ajax
	    // get data
	    if (isset($this->history[$key]['ajax'])
		    AND isset($this->history[$key]['ajax']['get'])) {
		// load data
		$get = $this->history[$key]['ajax']['get'];
	    }
	} else {
	    // no ajax
	    // get data
	    if (isset($this->history[$key])
		    AND isset($this->history[$key]['get'])) {
		// load data
		$get = $this->history[$key]['get'];
	    }
	}

	// return all if requested
	if ($name === true) return $get;

	// return all without module and event if requested
	if ($name === false) {
	    // unset module and event
	    if (isset($get['module'])) unset($get['module']);
	    if (isset($get['event'])) unset($get['event']);
	    return $get;
	}

	// check, if requested parameter exist
	if (!isset($get[$name])) return NULL;

	// return requested parameter
	return $get[$name];
    }

    /* get POST OR GET-parameters
     * @param string/bool: name of parameter (true will return all)
     * +@param int: module in history (0 = current; 1 = last; ...)
     *
     * @return string/array/bool
     */
    public function getParameter ($name, $time = 0) {

	// try to get POST-parameter
	$post = $this->getPost($name, $time);
	if (isset($post)) return $post;

	// try to get GET-parameter
	$get = $this->getGet($name, $time);
	if (isset($get)) return $get;

	// no parameter found
	return false;
    }

    /* get post-parameters with a certain preffix
     * @param string: preffix of post-name
     * +@param int: module in history (0 = current; 1 = last; ...)
     *
     * @return bool
     */
    public function getByPreffix ($preffix, $time = 0) {
	global $TSunic;

	// get all post-parameters
	$all_posts = $this->getPost(true, $time);

	// get requested elements
	$output = array();
	foreach ($all_posts as $index => $value) {
	    if (substr($index, 0, strlen($preffix)) == $preffix) {
		// add to output
		$output[substr($index, (strlen($preffix)+1))] = $value;
	    }
	}

	return $output;
    }

    /* get cookie-data
     * @param string: name of cookie
     *
     * @return string/bool/int
     */
    public function getCookie ($name) {
	// try to get cookie-value
	$output = (isset($_COOKIE[$name])) ? $_COOKIE[$name] : false ;
	return $output;
    }

    # ############################ handle history ######################### #

    /* get key of history-entry
     * +@param int: back-time
     *
     * @return int
     */
    protected function _getHistoryKey ($time = 0) {
	global $TSunic;

	// get current key
	end($this->history);
	$current_key = key($this->history);

	// get requested key
	$req_key = false;
	for ($i = $current_key; $i >= ($current_key - $this->history_amount); $i--) {

	    // check, if index OR ajax
	    if ($TSunic->isAjax()) {
		// ajax-run
		// skip false entries
		if (!isset($this->history[$i])
		    OR !isset($this->history[$i]['ajax'])
		    OR isset($this->history[$i]['skipped'])) continue;
	    } else {
		// normal run
		// skip false entries
		if (!isset($this->history[$i])
		    OR isset($this->history[$i]['ajax'])
		    OR isset($this->history[$i]['skipped'])) continue;
	    }

	    // check, if requested entry
	    if ($time == 0) {
		// get requested key
		$req_key = $i;
		break;
	    }

	    // decrease time
	    $time--;
	}

	return $req_key;
    }

    /* add data to history
     * @param string: unique name of information
     * @param mix: value
     * +@param int: back-time
     *
     * @return bool
     */
    public function addToHistory ($name, $value, $time = 0) {

	// get key
	$key = $this->_getHistoryKey($time);

	// add data to history
	if (!isset($this->history[$key]['other'])) $this->history[$key]['other'] = array();
	$this->history[$key]['other'][$name] = $value;

	return true;
    }

    /* get data from history
     * @param string: unique name of information
     * +@param int: back-time
     *
     * @return mix
     */
    public function getFromHistory ($name, $time = 0) {

	// get key
	$key = $this->_getHistoryKey($time);

	// add data to history
	if (!isset($this->history[$key]['other'])) return false;
	if (!isset($this->history[$key]['other'][$name])) return false;

	return $this->history[$key]['other'][$name];
    }

    /* is history
     * +@param int: back-time
     *
     * @return bool
     */
    public function isHistory ($time = 0) {

	// check, if history exists
	if ($this->getModule($time)) {
	    return true;
	}
	return false;
    }

    /* get current history id
     *
     * @return int
     */
    public function getCurrentHistoryId () {
	// get and return current id
	$current_id = $this->_getHistoryKey(0);
	return $current_id;
    }
}
?>
