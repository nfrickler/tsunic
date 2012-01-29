<!-- | class to handle statistics -->
<?php
/** header *********************************************************************
 * project:			TSunic 4.1.1 | system 1.1
 * file:			classes/Stats.class.php
 * author:			Nicolas Frinker <authornicolas@tsunic.de>
 * copyright:		Copyright 2011 Nicolas Frinker
 * licence:			This program is free software: you can redistribute it and/or modify
 * 					it under the terms of the GNU Affero General Public License as
 * 					published by the Free Software Foundation, either version 3 of the
 * 					License, or (at your option) any later version.
 * 
 * 					This program is distributed in the hope that it will be useful,
 * 					but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 					MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 					GNU Affero General Public License for more details.
 * 
 * 					You should have received a copy of the GNU Affero General Public License
 * 					along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * ************************************************************************** */

class $$$Stats {

	/* array with statistical data
	 * array
	 */	 
	protected $stats = array();

	/* constructor
	 *
	 * @return OBJECT
	 */
	public function __construct () {

		// start system-timer
		$this->startTimer('system');

		return;
	}

	/* start timer
	 * @param string $timer: name of timer
	 * @param bool $doReset: reset timer first?	 
	 *
	 * @return bool
	 */
	public function startTimer ($timer, $doReset = false) {

		// timer already exists?
		if ($doReset == true OR !isset($this->stats[$timer])) {
			$this->stats[$timer] = array('start' => 0,
										 'sum' => 0);
		}

		// save start-time
		$this->stats[$timer]['start'] = microtime(true);

		return true;
	}

	/* stop timer
	 * @param string $timer: name of timer
	 *
	 * @return bool
	 */
	public function stopTimer ($timer) {

		// timer already exists?
		if (!isset($this->stats[$timer])) {
			$this->stats[$timer] = array('start' => 0,
										 'sum' => 0);
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
	 * @param string $timer: name of timer
	 *
	 * @return bool
	 */
	public function getTimer ($timer) {

		// timer already exists?
		if (!isset($this->stats[$timer])) {
			$this->stats[$timer] = array('start' => 0,
										 'sum' => 0);
		}

		return $this->stats[$timer]['sum'];
	}
}
?>