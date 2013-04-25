<!-- | CLASS Stats -->
<?php
/** Handle statistics
 *
 * This class collects statistical information like runtime
 */
class $$$Stats {

    /** Statistical data
     * @var array $stats
     */
    protected $stats = array();

    /** Constructor
     */
    public function __construct () {

	// start system-timer
	$this->startTimer('system');

	return;
    }

    /** Start timer
     *
     * @param string $timer
     *	Name of timer
     * @param bool $doReset
     *	Reset timer first?
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

    /** Stop timer
     *
     * @param string $timer
     *	Name of timer
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

    /** Get current sum of timer
     *
     * @param string $timer
     *	Name of timer
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
