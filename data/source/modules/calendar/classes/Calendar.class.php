<!-- | CLASS Calendar -->
<?php
class $$$Calendar {

    /* all dates
     * array
     */
    protected $dates;

    /* get all dates
     * +@param int: minimal timestamp for start
     * +@param int: maximal timestamp for stop
     *
     * @return array
     */
    public function getDates ($from = 0, $to = 0) {
	$dates = array();

	// get all dates
	$all = $this->_getAllDates();
	$dates = array();

	// filter
	foreach ($all as $index => $Value) {

	    if ($Value->getWithin($from, $to)) {
		$dates[] = $Value;
	    }
	}

	// sort dates by start
	$dates = $this->sortDates($dates);

	return $dates;
    }

    /* load all dates
     *
     * @return array
     */
    protected function _getAllDates () {

	if (empty($this->dates)) {
	    global $TSunic;
	    $this->dates = array();

	    // get from database
	    $preffix = $TSunic->Config->get('preffix');
	    $classname = '$$$Date';
	    $sql = "SELECT id
		FROM ".$preffix."$bp$objects
		WHERE class = '$classname'
	    ;";
	    $result = $TSunic->Db->doSelect($sql);

	    // get objects
	    foreach ($result as $index => $values) {
		$this->dates[] = $TSunic->get('$$$Date', $values['id']);
	    }
	}

	return $this->dates;
    }

    /* sort dates by DATE__START
     * @param array: array with dates
     *
     * @return array
     */
    public function sortDates ($dates) {
	usort($dates, array($this, '_sortDates_cb'));
	return $dates;
    }

    /* sort dates by DATE__START (callback)
     * @param array: array with dates
     *
     * @return array
     */
    protected function _sortDates_cb ($Date1, $Date2) {
	if ($Date1->getInfo('start') == $Date2->getInfo('start')) return 0;
	return ($Date1->getInfo('start') < $Date2->getInfo('start')) ? -1 : 1;
    }
}
?>
