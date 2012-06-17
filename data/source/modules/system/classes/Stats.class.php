<!-- | class to handle statistics -->
<?php
class $$$Stats {

    /* array with statistical data
     * array
     */
    protected $stats = array();

    /* constructor
     */
    public function __construct () {

	// start system-timer
	$this->startTimer('system');

	return;
    }

    /* start timer
     * @param string: name of timer
     * @param bool: reset timer first?
     *
     * @return bool
     */
    public function startTimer ($timer, $doReset = false) {

	// timer already exists?
	if ($doReset == true OR !isset($this->stats[$timer])) {
	    $this->stats[$timer] = array('start' => 0, 'sum' => 0);
	}

	// save start-time
	$this->stats[$timer]['start'] = microtime(true);

	return true;
    }

    /* stop timer
     * @param string: name of timer
     *
     * @return bool
     */
    public function stopTimer ($timer) {

	// timer already exists?
	if (!isset($this->stats[$timer])) {
	    $this->stats[$timer] = array('start' => 0, 'sum' => 0);
	}

	// is started?
	if ($this->stats[$timer]['start'] == 0) {
	    // timer not started!
	    return false;
	}

	// add time to sum
	$this->stats[$timer]['sum'] += (microtime(true) - $this->stats[$timer]['start']);

	return true;
    }

    /* get sum of timer
     * @param string: name of timer
     *
     * @return bool
     */
    public function getTimer ($timer) {

	// timer already exists?
	if (!isset($this->stats[$timer])) {
	    $this->stats[$timer] = array('start' => 0, 'sum' => 0);
	}

	return $this->stats[$timer]['sum'];
    }
}
?>
