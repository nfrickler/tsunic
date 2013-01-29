<!-- | CLASS Date -->
<?php
class $$$Date extends $bp$BpObject {

    /* tags to be connected with this object
     * array
     */
    protected $tags = array(
	'DATE__START',
	'DATE__STOP',
	'DATE__LENGTH',
	'DATE__TITLE',
	'DATE__REPEAT',
	'DATE__REPEATTYPE',
	'DATE__REPEATCOUNT',
	'DATE__REPEATSTOP',
    );

    /* is valid title for date?
     * @param string: title
     *
     * @return bool
     */
    public function isValidTitle ($title) {
	return ($title and $this->_validate($title, 'extString'))
	    ? true : false;
    }

    /* get corresponding end to start
     * +@param int: start
     *
     * @return int
     */
    public function getStop ($start = 0) {
	if (empty($start)) $start = $this->getInfo('start');
	$period = $this->getInfo('stop') - $this->getInfo('start');
	return $start + $period;
    }

    /* get next start time of repetition of date
     * @param int: timestamp of start
     * +@param bool: count up? (down otherwise)
     *
     * @return int
     */
    public function nextRepeat ($start, $up = true) {
	global $TSunic;

	$type = $TSunic->get('$bp$Selection', $this->getInfo('repeattype'))->getInfo('name');
	$repeat = $this->getInfo('repeat');
	if (empty($repeat)) $repeat = 1;
	$pref = ($up) ? '+' : '-';

	// extract type
	$type = substr($type, -2, 1);

	// return new start
	switch ($type) {
	    case 'Y':
		return strtotime($pref."$repeat years", $start);
		break;
	    case 'M':
		return strtotime($pref."$repeat months", $start);
		break;
	    case 'D':
		return strtotime($pref."$repeat days", $start);
		break;
	    case 'H':
		return strtotime($pref."$repeat hours", $start);
		break;
	    case 'I':
		return strtotime($pref."$repeat minutes", $start);
		break;
	}

	// log error
	$TSunic->Log->log(1, "calendar__Date: Error: RepeatType not found!");

	// add one to prevent infinite loops
	return $start+1;
    }

    /* get start of date within a certain time space?
     * @param int: from
     * @param int: to
     *
     * @return array
     */
    public function getWithin ($from, $to) {
	$out = array();

	// get start params
	$start = $this->getInfo('start');
	$stop = $this->getInfo('stop');
	$repeatcount = $this->getInfo('repeatcount');
	if (!$repeatcount) $repeatcount = 0;
	$repeatstop = $this->getInfo('repeatstop');
	$isCount = ($repeatcount > 0 or empty($repeatstop)) ? true : false;

	// is start before to?
	if ($start > $to) return $out;

	// get period of date
	$period = $stop - $start;

	// search for first date within period
	while (($start < $to) and (($isCount and $repeatcount >= 0) or (!$isCount and $start < $repeatstop))) {

	    // found sth?
	    if ((($start+$period) < $from and ($start+$period) >= $from)
		or ($start >= $from and $start < $to)
	    ) {
		// found it!
		$out[] = array('time' => $start, 'Date' => $this);
	    }

	    // increment
	    $repeatcount--;
	    $start = $this->nextRepeat($start);
	}

	return $out;
    }
}
?>
