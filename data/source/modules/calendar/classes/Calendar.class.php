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

	    // from?
	    if ($Value->getInfo('start') < $from) continue;

	    // to?
	    if ($to and $Value->getInfo('stop') > $to) continue;

	    // add to array
	    $dates[] = $Value;
	}

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
}
?>
