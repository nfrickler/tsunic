<!-- | CLASS Calendar -->
<?php
/** Calendar class
 *
 * Calendar holding all Date objects.
 */
class $$$Calendar {

    /** All dates
     * @var array $dates
     */
    protected $dates;

    /** Get all dates
     * @param int $from
     *	Minimal timestamp for start
     * @param int $to
     *	Maximal timestamp for stop
     *
     * @return array
     */
    public function getDates ($from = 0, $to = 0) {
	$dates = array();

	// get all dates
	$all = $this->_getAllDates();

	// filter
	foreach ($all as $index => $Value) {
	    $dates = array_merge($dates, $Value->getWithin($from, $to));
	}

	// sort dates by start
	$dates = $this->sortDates($dates);

	return $dates;
    }

    /** Load all dates
     *
     * @return array
     */
    protected function _getAllDates () {

	if (empty($this->dates)) {
	    global $TSunic;
	    $this->dates = array();

	    // get from database
	    $prefix = $TSunic->Config->get('prefix');
	    $classname = '$$$Date';
	    $sql = "SELECT obj.id as id
		FROM ".$prefix."$bp$objects as obj
		WHERE obj.class = '$classname'
		    AND fk_account = '".$TSunic->Usr->getInfo('id')."'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);

	    // get objects
	    foreach ($result as $index => $values) {
		$this->dates[] = $TSunic->get('$$$Date', $values['id']);
	    }
	}

	return $this->dates;
    }

    /** Sort dates by DATE__START
     * @param array $dates
     *	Array with dates
     *
     * @return array
     */
    public function sortDates ($dates) {
	usort($dates, array($this, '_sortDates_cb'));
	return $dates;
    }

    /** Sort dates by time, Date->name (callback)
     * @param array $Date1
     *	First date
     * @param array $Date2
     *	Second date
     *
     * @return int
     */
    protected function _sortDates_cb ($Date1, $Date2) {
	if ($Date1['time'] == $Date2['time']) {
	    // sort by title of date
	    return strcmp($Date1['Date']->getInfo('title'), $Date2['Date']->getInfo('title'));
	}
	return ($Date1['time'] < $Date2['time']) ? -1 : 1;
    }
}
?>
