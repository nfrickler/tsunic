<!-- | CLASS Date -->
<?php
/** Date class
 *
 * This class offers dates to be used in the Calendar
 */
class $$$Date extends $bp$BpObject {

    /** Tags to be connected with this object
     * @var array $tags
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

    /** Is valid title for date?
     * @param string $title
     *	Title
     *
     * @return bool
     */
    public function isValidTitle ($title) {
	return ($title and $this->_validate($title, 'extString'))
	    ? true : false;
    }

    /** Get corresponding end to start
     * @param int $start
     *	Start
     *
     * @return int
     */
    public function getStop ($start = 0) {
	if (empty($start)) $start = $this->getInfo('start');
	$period = $this->getInfo('stop') - $this->getInfo('start');
	return $start + $period;
    }

    /** Get next start time of repetition of date
     * @param int $start
     *	Timestamp of start
     * @param string $repeattype
     *	Type of repitition
     * @param bool $up
     *	Count up? (down otherwise)
     *
     * @return int
     */
    public function nextRepeat ($start, $repeattype, $up = true) {
	$repeat = $this->getInfo('repeat');
	if (empty($repeat)) $repeat = 1;
	$pref = ($up) ? '+' : '-';

	// return new start
	switch ($repeattype) {
	    case 'Y':
		return strtotime($pref."$repeat years", $start);
		break;
	    case 'M':
		return strtotime($pref."$repeat months", $start);
		break;
	    case 'D':
		return $start + $repeat * 24 * 3600;
		break;
	    case 'H':
		return $start + $repeat * 3600;
		break;
	    case 'I':
		return $start + $repeat * 60;
		break;
	}

	// log error
	global $TSunic;
	$TSunic->Log->log(1, "calendar__Date: Error: RepeatType not found!");

	// add one to prevent infinite loops
	return $start+1;
    }

    /** Move start in front of $from
     * @param int $start
     *	Timestamp to forward
     * @param int $from
     *	Timestamp to forward to
     * @param int $repeatcount
     *	Repeatcount
     * @param int $repeatstop
     *	Repeatstop
     * @param string $repeattype
     *	Repeattype
     *
     * @return int
     */
    public function fastForward (
	$start, $from, $repeatcount, $repeatstop, $repeattype
    ) {

	// get period or return
	switch ($repeattype) {
	    case 'Y':
	    case 'M':
		return array($start, $repeatcount);
		break;
	    case 'D':
		$period = 24*3600;
		break;
	    case 'H':
		$period = 3600;
		break;
	    case 'I':
		$period = 60;
		break;
	    default:
		global $TSunic;
		$TSunic->Log->log(3, "calendar::Date::fastForward ERROR: invalid repeattype!");
		return array($start, $repeatcount);
	}

	// get diff
	$diff = $from - $start;

	// update repeatcount
	$repeated_times = (int) ($diff/$period);
	$repeatcount -= $repeated_times;

	// update start
	$start += $repeated_times * $period;

	return array($start, $repeatcount);
    }

    /** Get start of date within a certain time space?
     * @param int $from
     *	Timestamp from
     * @param int $to
     *	Timestamp to
     *
     * @return array
     */
    public function getWithin ($from, $to) {
	global $TSunic;
	$out = array();

	// get start params
	$start = $this->getInfo('start');
	$stop = $this->getInfo('stop');
	$repeatcount = $this->getInfo('repeatcount');
	if (!$repeatcount) $repeatcount = 0;
	$repeatstop = $this->getInfo('repeatstop');
	$isCount = ($repeatcount > 0 or empty($repeatstop)) ? true : false;

	// repeattype
	$repeattype = $TSunic->get('$bp$Selection', $this->getInfo('repeattype'))->getInfo('name');
	$repeattype = substr($repeattype, -2, 1);

	// is start before to?
	if ($start > $to) return $out;

	// get period of date
	$period = $stop - $start;

	// fast-forward (performance)
	if ($from - $start > 365*24*3600) {
	    list($start,$repeatcount) = $this->fastForward($start, $from, $repeatcount, $repeatstop, $repeattype);
	}

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
	    $start = $this->nextRepeat($start, $repeattype);
	}

	return $out;
    }

    /** Get name of this object (this will be the one shown to user)
     *
     * @return string
     */
    public function getName () {
	return $this->getInfo('title').' ('.date('d.m.Y H:i:s', $this->getInfo('start')).')';
    }
}
?>
