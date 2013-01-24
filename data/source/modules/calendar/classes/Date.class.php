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

	return $start;
    }

    /* get start of date within a certain time space?
     * @param int: from
     * @param int: to
     *
     * @return int
     */
    public function getWithin ($from, $to) {

	// get start params
	$start = $this->getInfo('start');
	$stop = $this->getInfo('stop');
	$repeatcount = $this->getInfo('repeatcount');
	if (!$repeatcount) $repeatcount = 0;
	$repeatstop = $this->getInfo('repeatstop');

	// get period of date
	$period = $stop - $start;

	// search for first date within period
	$found = 0;
	while (!$found and $repeatcount >= 0 and (empty($repeatstop) or $start < $repeatstop)) {

	    // found sth?
	    if ((($start+$period) < $from and ($start+$period) > $from)
		or ($start > $from and $start < $to)
	    ) { 
		// found it!
		$found = $start;
	    }

	    // increment
	    $repeatcount--;
	    $start = $this->nextRepeat($start);
	}

	return $found;
    }
}
?>
